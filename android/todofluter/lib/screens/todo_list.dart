import 'dart:convert';

import 'package:flutter/material.dart';

import 'add_page.dart';

import 'package:http/http.dart' as http;

class TodoListPage extends StatefulWidget {
  const TodoListPage({Key? key}) : super(key: key);

  @override
  State<TodoListPage> createState() => _TodoListPageState();
}

class _TodoListPageState extends State<TodoListPage> {
  bool isLoading = true;

  List items = [];

  @override
  void initState() {
    super.initState();
    fetchTodo();
  }

  @override
  Widget build(BuildContext context) {
    return Scaffold(
      appBar: AppBar(
        title: Text('Todo List'),
      ),
      body: Visibility(
        visible: isLoading,
        child: Center(
          //Rond qui tourne pour charger la page
          child: CircularProgressIndicator(),
        ),
        replacement: RefreshIndicator(
          onRefresh: fetchTodo,
          child: ListView.builder(
              itemCount: items.length,
              itemBuilder: (context, index) {
                final item = items[index] as Map;
                final id = item['_id'] as String;
                return ListTile(
                  leading: Text('${index + 1}'),
                  title: Text(item['title']),
                  subtitle: Text(item['description']),
                  //title: Text(item.toString()),
                  //title: Text(item['_id']),
                  //Menu sup pour edit ou sup une tache
                  trailing: PopupMenuButton(
                    onSelected: (value){
                      if(value == 'edit'){
                        //Renvoie sur la page de modification
                        navigateToEditPage(item);
                      }else if(value == 'delete'){
                        //Supprime notre tache faut après actualiser
                        deleteById(id);
                      }
                    },
                    itemBuilder: (context) {
                      return [
                        PopupMenuItem(child: Text('Modifier'),
                        value: 'edit',),
                        PopupMenuItem(child: Text('Supprimer'), value: 'delete',),
                      ];
                    },
                  ),
                );
              }),
        ),
      ),
      floatingActionButton: FloatingActionButton.extended(
          onPressed: navigateToAddPage, label: Text('Ajouter une tâche')),
    );
  }

  Future<void> navigateToEditPage(Map item)  async{
    final route = MaterialPageRoute(
      builder: (context) => AddTodoPage(todo:item),
    );
    await Navigator.push(context, route);
    setState(() {
      isLoading = true;
    });
    fetchTodo();  }

  Future<void> navigateToAddPage() async {
    final route = MaterialPageRoute(
      builder: (context) => AddTodoPage(),
    );
    await Navigator.push(context, route);
    setState(() {
      isLoading = true;
    });
    fetchTodo();
  }

  Future<void> deleteById(String id) async{
      //Delete the task
    final url = 'http://api.nstack.in/v1/todos/$id';
    final uri = Uri.parse(url);
    final reponse = await http.delete(uri);
    if(reponse.statusCode == 200){
      final filtre = items.where((element) => element('_id')!= id).toList();
      setState(() {
        items = filtre;
      });
    }else{
      showErreurMessage('La supression a échoué !');
    }


  }

  Future<void> fetchTodo() async {
    final url = 'http://api.nstack.in/v1/todos?page=1&limit=20';

    final uri = Uri.parse(url);
    final response = await http.get(uri);
    if (response.statusCode == 200) {
      final json = jsonDecode(response.body) as Map;
      final result = json['items'] as List;
      setState(() {
        items = result;
      });
    } else {
      //Montré une erreur
      print(response.body);
    }
    setState(() {
      isLoading = false;
    });
  }
  void showSuccessMessage(String message) {
    final snackBar = SnackBar(
      content: Text(message, style: TextStyle(color: Colors.white)),
      backgroundColor: Colors.green,
    );
    ScaffoldMessenger.of(context).showSnackBar(snackBar);
  }

  void showErreurMessage(String message) {
    final snackBar = SnackBar(
      content: Text(message, style: TextStyle(color: Colors.white)),
      backgroundColor: Colors.red,
    );
    ScaffoldMessenger.of(context).showSnackBar(snackBar);
  }
}
