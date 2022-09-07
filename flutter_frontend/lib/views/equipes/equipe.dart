import 'package:flutter/material.dart';
import 'package:http/http.dart' as http;
import 'dart:convert';

class Equipe {
  final int id;
  final String nome;
  final String localPertencente;
  final int? numberOfGols;
  final int? numberOfCartoes;
  final int? numberOfSubstituicoes;
  final int? numberOfJogadores;

  const Equipe({
    required this.id,
    required this.nome,
    required this.localPertencente,
    this.numberOfGols,
    this.numberOfCartoes,
    this.numberOfSubstituicoes,
    this.numberOfJogadores,
  });

  factory Equipe.fromJSON(Map<String, dynamic> json) {
    return Equipe(
      id: json['id'],
      nome: 'F.C. ${json['nome']}',
      localPertencente: json['local_pertencente'],
      numberOfGols: json['gols']?.length,
      numberOfCartoes: json['cartoes']?.length,
      numberOfSubstituicoes: json['substituicoes']?.length,
      numberOfJogadores: json['jogadores']?.length,
    );
  }
}

Future<Equipe> fetchEquipe({required final int id}) async {
  final response =
      await http.get(Uri.parse('http://0.0.0.0:8000/api/v1/equipes/$id'));

  if (response.statusCode == 200) {
    return Equipe.fromJSON(jsonDecode(response.body));
  } else {
    throw Exception('Failed to load equipe');
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
        body: SingleChildScrollView(
          child: Center(
            child: Column(
              children: [
                SizedBox(
                  width: 400,
                  child: Card(
                    child: Image.asset(
                      'images/clube_de_futebol.png',
                      scale: 1.2,
                    ),
                  ),
                ),
                SizedBox(
                  width: 400,
                  height: 400,
                  child: GridView.count(
                    crossAxisCount: 2,
                    children: [
                      Card(
                        child: Center(
                          child: Text(
                            'Gols: ${equipe.numberOfGols ?? 0}',
                            style: Theme.of(context).textTheme.headline5,
                          ),
                        ),
                      ),
                      Card(
                        child: Center(
                          child: Text(
                            'Substituições: ${equipe.numberOfSubstituicoes ?? 0}',
                            style: Theme.of(context).textTheme.headline5,
                          ),
                        ),
                      ),
                      Card(
                        child: Center(
                          child: Text(
                            'Jogadores: ${equipe.numberOfJogadores ?? 0}',
                            style: Theme.of(context).textTheme.headline5,
                          ),
                        ),
                      ),
                      Card(
                        child: Center(
                          child: Text(
                            'Cartões: ${equipe.numberOfCartoes ?? 0}',
                            style: Theme.of(context).textTheme.headline5,
                          ),
                        ),
                      ),
                    ],
                  ),
                ),
              ],
            ),
          ),
        ));
  }
}
