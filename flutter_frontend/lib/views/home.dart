import 'package:flutter/material.dart';
import 'confrontos/confrontos.dart';
import 'equipes/equipes.dart';
import './sobre.dart';

class HomePage extends StatefulWidget {
  const HomePage({super.key});

  @override
  State<HomePage> createState() => _HomePageState();
}

class _HomePageState extends State<HomePage> {
  int _selectedIndex = 0;

  static final List<Widget> _sections = <Widget>[];

  @override
  void initState() {
    super.initState();

    _sections.add(ViewConfrontos(confrontos: fetchConfrontos()));
    _sections.add(ViewEquipes(equipes: fetchEquipes()));
    _sections.add(ViewSobre());
  }

  @override
  Widget build(BuildContext context) {
    return Scaffold(
      appBar: AppBar(title: const Text('Copa Catar 2022 - Match Tracker')),
      body: Center(
        child: _sections.elementAt(_selectedIndex),
      ),
      bottomNavigationBar: BottomNavigationBar(
        items: const <BottomNavigationBarItem>[
          BottomNavigationBarItem(
            icon: Icon(Icons.sports_soccer),
            label: 'Confrontos',
          ),
          BottomNavigationBarItem(
            icon: Icon(Icons.sports_kabaddi_sharp),
            label: 'Equipes',
          ),
          BottomNavigationBarItem(
            icon: Icon(Icons.question_mark),
            label: 'Sobre',
          ),
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
