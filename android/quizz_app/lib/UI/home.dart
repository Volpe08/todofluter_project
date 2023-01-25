import 'package:flutter/material.dart';

class QuizzApp extends StatelessWidget {
  @override
  Widget build(BuildContext context) {
    return Scaffold(
      appBar: AppBar(
        title: const Text('Super Quiz'),
        centerTitle: true,
        backgroundColor: Colors.blueAccent,
      ),
      backgroundColor: Colors.blueAccent,
      body: Container(
        child: Column(
          mainAxisAlignment: MainAxisAlignment.center,
          children: [
            Center(
              child: Image.asset('images/img.png', width: 250, height: 180),
            )
          ],
        ),
      ),
    );
  }
}
