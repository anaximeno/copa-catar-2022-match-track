import 'package:flutter/foundation.dart';
import 'package:flutter/material.dart';
import 'package:flutter_frontend/views/confrontos/confronto.dart';
import 'package:http/http.dart' as http;
import '../../misc/assets.dart' as assets;
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
  final Future<List<Equipe>> equipes;

  const ViewEquipes({super.key, required this.equipes});

  @override
  State<ViewEquipes> createState() => _ViewEquipesState();
}

class _ViewEquipesState extends State<ViewEquipes> {

  @override
  Widget build(BuildContext context) {
    return FutureBuilder<List<Equipe>>(
      future: widget.equipes,
      builder: (context, snapshot) {
        if (snapshot.hasData) {
          final equipes = snapshot.data!;

          return ListView.builder(
            itemCount: equipes.length + 1, // NOTE: ADD TITLE
            itemBuilder: ((context, index) {
              if (index == 0) {
                // NOTE: TITLE
                return Container(
                  margin: const EdgeInsets.all(40),
                  child: Center(
                    child: Text(
                      'Equipes',
                      style: Theme.of(context).textTheme.headline2,
                    ),
                  ),
                );
              } else {
                index -= 1;
              }

              return Card(
                elevation: 2,
                child: ListTile(
                  leading: Image.asset(
                    assets.imgClubeDeFutebol,
                    scale: 10,
                  ),
                  title: Text(equipes[index].nome),
                  subtitle: Text('De: ${equipes[index].localPertencente}'),
                  onTap: (() {
                    Navigator.of(context).push(
                      MaterialPageRoute(
                        builder: (BuildContext context) =>
                            ViewEquipe(equipe: equipes[index]),
                      ),
                    );
                  }),
                ),
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
