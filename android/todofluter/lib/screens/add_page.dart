import 'dart:convert';
import 'dart:io';

import 'package:flutter/material.dart';
import 'package:http/http.dart' as http;

class AddTodoPage extends StatefulWidget {
  final Map? todo;

  const AddTodoPage({
    super.key,
    this.todo,
  });

  @override
  State<AddTodoPage> createState() => _AddTodoPageState();
}

class _AddTodoPageState extends State<AddTodoPage> {
  TextEditingController titleController = TextEditingController();
  TextEditingController descriptionController = TextEditingController();

  bool isEdit = false;

  @override
  void initState() {
    // TODO: implement initState
    super.initState();
    final todo = widget.todo;
    if (todo != null) {
      isEdit = true;
      final title = todo['title'];
      final description = todo['description'];
      titleController.text = title;
      descriptionController.text = description;
    }
  }

  @override
  Widget build(BuildContext context) {
    return Scaffold(
      appBar: AppBar(
        title: Text(isEdit ? 'Edit de la tache' : 'Ajout d\'une tâche'),
      ),
      body: ListView(
        padding: EdgeInsets.all(20),
        children: [
          TextField(
            controller: titleController,
            decoration: InputDecoration(
              hintText: 'Titre',
            ),
          ),
          TextField(
            controller: descriptionController,
            decoration: InputDecoration(
              hintText: 'Déscription',
            ),
            keyboardType: TextInputType.multiline,
            minLines: 5,
            maxLines: 8,
          ),
          SizedBox(height: 20),
          //Bouton en bas
          ElevatedButton(
            onPressed: isEdit ? updateData : submitData,
            child: Padding(
              padding: const EdgeInsets.all(16.0),
              child: Text(isEdit ? 'Modifier' :'Envoyé'),
            ),
          )
        ],
      ),
    );
  }

  Future <void> updateData() async{
    //Récupération des donner json de notre todo
    final todo = widget.todo;
    if(todo == null){
      print('Tu ne peut pas modifier sans data');
      return;
    }
    final id = todo['_id'];
    final title = titleController.text;
    final description = descriptionController.text;
    final body = {
      "title": title,
      "description": description,
      "is_completed": false,
    };

    //Appel de notre api
    final url = 'http://api.nstack.in/v1/todos/$id';
    final uri = Uri.parse(url);
    final response = await http.put(
      uri,
      body: jsonEncode(body),
      headers: {'Content-Type': 'application/json'},
    );

    //Code réponse de notre statut (api)

    if (response.statusCode == 200) {

      showSuccessMessage('Modification réussi');

    } else {
      showErreurMessage("Erreur lors de la modification");

    }
    Navigator.pop(context); //Revient a la page précédente

  }

  Future<void> submitData() async {
    // Récuparation des donné sur formulaire
    final title = titleController.text;
    final description = descriptionController.text;
    final body = {
      "title": title,
      "description": description,
      "is_completed": false,
    };



    //Appel de notre api
    final url = 'http://api.nstack.in/v1/todos';
    final uri = Uri.parse(url);
    final response = await http.post(
      uri,
      body: jsonEncode(body),
      headers: {'Content-Type': 'application/json'},
    );

    print(response.statusCode);

    if (response.statusCode == 201) {
      //Affiche le message dans notre terminal
      print('Création réussi');
      titleController.text = ''; //Remet les variable a vide
      descriptionController.text = '';
      showSuccessMessage('Création réussi');
      //sleep(duration);

    } else {
      showErreurMessage("Erreur lors de la création");
      //sleep(duration);

    }
    Navigator.pop(context); //Revient a la page précédente
  }

  void showSuccessMessage(String message) {
    //Barre en bas contenant notre message a afficher a l'utilisateur
    final snackBar = SnackBar(
      content: Text(message, style: TextStyle(color: Colors.white)),
      backgroundColor: Colors.green,
    );
    ScaffoldMessenger.of(context).showSnackBar(snackBar);
  }

  void showErreurMessage(String message) {
    //Barre en bas contenant notre message a afficher a l'utilisateur
    final snackBar = SnackBar(
      content: Text(message, style: TextStyle(color: Colors.white)),
      backgroundColor: Colors.red,
    );
    ScaffoldMessenger.of(context).showSnackBar(snackBar);
  }
}
