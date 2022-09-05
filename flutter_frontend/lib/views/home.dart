import 'package:flutter/material.dart';

class HomePage extends StatefulWidget {
  const HomePage({super.key});

  @override
  State<HomePage> createState() => _HomePageState();
}

class _HomePageState extends State<HomePage> {
  int _selectedIndex = 0;

  static const List<Widget> _sections = <Widget>[
    Text('Index 0: Confrontos'),
    Text('Index 1: Equipes'),
    Text('Index 2: Sobre'),
  ];

  void _onItemTapped(int index) {
    setState(() {
      _selectedIndex = index;
    });
  }

  @override
  Widget build(BuildContext context) {
    return Scaffold(
      body: Center(child: _sections.elementAt(_selectedIndex)),
      bottomNavigationBar: BottomNavigationBar(
        items: const <BottomNavigationBarItem>[
          BottomNavigationBarItem(icon: Icon(Icons.sports_soccer), label: 'Confrontos'),
          BottomNavigationBarItem(icon: Icon(Icons.sports_kabaddi_sharp), label: 'Equipes'),
          BottomNavigationBarItem(icon: Icon(Icons.question_mark), label: 'Sobre'),
        ],
        currentIndex: _selectedIndex,
        selectedItemColor: Colors.purple[800],
        onTap: _onItemTapped
      ),
    );
  }
}
