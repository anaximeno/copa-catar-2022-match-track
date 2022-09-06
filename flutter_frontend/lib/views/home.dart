import 'package:flutter/material.dart';
import 'package:flutter_frontend/views/confrontos/confrontos.dart';
import 'equipes/equipes.dart';

class HomePage extends StatefulWidget {
  const HomePage({super.key});

  @override
  State<HomePage> createState() => _HomePageState();
}

class _HomePageState extends State<HomePage> {
  int _selectedIndex = 0;

  static const List<Widget> _sections = <Widget>[
    ViewConfrontos(),
    ViewEquipes(),
    Text('Index 2: Sobre'),
  ];

  @override
  Widget build(BuildContext context) {
    return Scaffold(
      body: Center(
        child: _sections.elementAt(_selectedIndex),
      ),
      bottomNavigationBar: BottomNavigationBar(
        items: const <BottomNavigationBarItem>[
          BottomNavigationBarItem(
              icon: Icon(Icons.sports_soccer), label: 'Confrontos'),
          BottomNavigationBarItem(
              icon: Icon(Icons.sports_kabaddi_sharp), label: 'Equipes'),
          BottomNavigationBarItem(
              icon: Icon(Icons.question_mark), label: 'Sobre'),
        ],
        currentIndex: _selectedIndex,
        selectedItemColor: Colors.indigo,
        onTap: (int index) {
          setState(() {
            _selectedIndex = index;
          });
        },
      ),
    );
  }
}
