import 'package:flutter/material.dart';
import 'package:http/http.dart' as http;
import 'dart:convert';

class Equipe {
  final int id;
  final String nome;
  final String localPertencente;

  const Equipe({
    required this.id,
    required this.nome,
    required this.localPertencente,
  });

  factory Equipe.fromJSON(Map<String, dynamic> json) {
    return Equipe(
      id: json['id'],
      nome: json['nome'],
      localPertencente: json['local_pertencente'],
    );
  }
}

Future<Equipe> fetchEquipe({required final int id}) async {
  final response =
      await http.get(Uri.parse('http://0.0.0.0:8000/api/v1/equipes/$id'));

  if (response.statusCode == 200) {
    return Equipe.fromJSON(jsonDecode(response.body));
  } else {
    throw Exception('Failed to load album');
  }
}

class ViewEquipe extends StatelessWidget {
  final Equipe equipe;

  const ViewEquipe({
    super.key,
    required this.equipe,
  });

  @override
  Widget build(BuildContext context) {
    return Scaffold(
      appBar: AppBar(
        title: Text(equipe.nome),
      ),
      body: Column(
        children: [
          Row(
            children: [
              Image.asset(
                'images/clube_de_futebol.png',
                scale: 1.5,
              ),
              Column(
                children: [
                  Row(
                    children: [
                      Container(
                        width: 100,
                        height: 100,
                        color: const Color.fromARGB(255, 255, 191, 0),
                        child: Column(
                          children: [
                            Text(
                              'Gols',
                              style: Theme.of(context).textTheme.headline5,
                            ),
                            Text(
                              '#',
                              style: Theme.of(context).textTheme.headline6,
                            ) // TODO: get gols from the API
                          ],
                        ),
                      ),
                      Container(
                        width: 100,
                        height: 100,
                        color: Colors.blue,
                        child: Column(
                          children: [
                            Text(
                              'Cartões',
                              style: Theme.of(context).textTheme.headline5,
                            ),
                            Text(
                              '#',
                              style: Theme.of(context).textTheme.headline6,
                            ) // TODO: get cartoes from the API
                          ],
                        ),
                      ),
                    ],
                  ),
                  Row(
                    children: [
                      Container(
                        width: 100,
                        height: 100,
                        color: Colors.red,
                        child: Column(
                          children: [
                            Text(
                              'Jogadores',
                              style: Theme.of(context).textTheme.headline5,
                            ),
                            Text(
                              '#',
                              style: Theme.of(context).textTheme.headline6,
                            ) // TODO: get jogadores from the API
                          ],
                        ),
                      ),
                      Container(
                        width: 100,
                        height: 100,
                        color: Colors.green,
                        child: Column(
                          children: [
                            Text(
                              'Confrontos',
                              style: Theme.of(context).textTheme.headline5,
                            ),
                            Text(
                              '#',
                              style: Theme.of(context).textTheme.headline6,
                            ) // TODO: get confrontos from the API
                          ],
                        ),
                      ),
                    ],
                  ),
                ],
              ),
            ],
          ),
        ],
      ),
    );
  }
}
