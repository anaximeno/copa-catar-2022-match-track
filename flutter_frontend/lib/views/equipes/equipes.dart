import 'package:flutter/foundation.dart';
import 'package:flutter/material.dart';
import 'package:http/http.dart' as http;
import 'dart:convert';
import 'equipe.dart';

List<Equipe> parseEquipes(String responseBody) {
  final parsed = jsonDecode(responseBody).cast<Map<String, dynamic>>();
  return parsed.map<Equipe>((json) => Equipe.fromJSON(json)).toList();
}

Future<List<Equipe>> fetchEquipes() async {
  final response =
      await http.get(Uri.parse('http://0.0.0.0:8000/api/v1/equipes'));
  return compute(parseEquipes, response.body);
}

class ViewEquipes extends StatefulWidget {
  const ViewEquipes({super.key});

  @override
  State<ViewEquipes> createState() => _ViewEquipesState();
}

class _ViewEquipesState extends State<ViewEquipes> {
  late Future<List<Equipe>> _equipes;

  @override
  void initState() {
    super.initState();
    _equipes = fetchEquipes();
  }

  @override
  Widget build(BuildContext context) {
    return FutureBuilder<List<Equipe>>(
      future: _equipes,
      builder: (context, snapshot) {
        if (snapshot.hasData) {
          final equipes = snapshot.data!;

          return ListView.builder(
            itemCount: equipes.length,
            itemBuilder: ((context, index) {
              return Row(
                children: [
                  Image.asset('images/clube_de_futebol.png', scale: 10,),
                  Column(
                    children: <Widget>[
                      Row(
                        children: <Widget>[
                          const Text('Nome: '),
                          Text(equipes[index].nome),
                        ],
                      ),
                      Row(
                        children: <Widget>[
                          const Text('Local pertencente: '),
                          Text(equipes[index].localPertencente),
                        ],
                      )
                    ],
                  ),
                ],
              );
            }),
          );
        } else if (snapshot.hasError) {
          return Text('${snapshot.error}');
        }

        return const CircularProgressIndicator();
      },
    );
  }
}