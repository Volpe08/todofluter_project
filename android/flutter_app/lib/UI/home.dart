import 'package:flutter/material.dart';

class ScaffoldExemple extends StatelessWidget {
  @override
  Widget build(BuildContext context) {
    return Scaffold(
      appBar: AppBar(
        title: const Text("First flutter project"),
        centerTitle: true,
        backgroundColor: Colors.amberAccent.shade700,
      ),
      backgroundColor: Colors.redAccent.shade200,
      body: Container(
        alignment: Alignment.center,
        child: Column(
          mainAxisAlignment: MainAxisAlignment.center,
          children: const [
            Text("Hello World")
          ],
        ),
      ),
      floatingActionButton:FloatingActionButton(
        backgroundColor: Colors.lightGreen,
        child: const Icon(Icons.ac_unit),
        onPressed: ()=>debug,
      ),
    );
  }
}
