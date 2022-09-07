import 'package:flutter/material.dart';
import 'package:flutter_frontend/views/jogadores/jogador.dart';
import 'package:http/http.dart' as http;
import 'dart:convert';

class Equipe {
  final int id;
  final String nome;
  final String localPertencente;
  final int? numberOfGols;
  final int? numberOfCartoes;
  final int? numberOfSubstituicoes;
  final List<Jogador>? jogadores;

  const Equipe(
      {required this.id,
      required this.nome,
      required this.localPertencente,
      this.numberOfGols,
      this.numberOfCartoes,
      this.numberOfSubstituicoes,
      this.jogadores});

  factory Equipe.fromJSON(Map<String, dynamic> json) {
    return Equipe(
      id: json['id'],
      nome: 'F.C. ${json['nome']}',
      localPertencente: json['local_pertencente'],
      numberOfGols: json['gols']?.length,
      numberOfCartoes: json['cartoes']?.length,
      numberOfSubstituicoes: json['substituicoes']?.length,
      jogadores: json['jogadores']
          ?.map<Jogador>((json) => Jogador.fromJSON(json))
          .toList(),
    );
  }

  get numberOfJogadores {
    return jogadores?.length;
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
                Card(
                  color: Theme.of(context).backgroundColor,
                  elevation: 0,
                  child: Column(
                    children: [
                      Container(
                        margin: const EdgeInsets.only(bottom: 10),
                        child: Text(
                          'Jogadores',
                          style: Theme.of(context).textTheme.headline3,
                          textAlign: TextAlign.center,
                        ),
                      ),
                      ConstrainedBox(
                        constraints: const BoxConstraints(
                            maxWidth: 400, maxHeight: 1000),
                        child: ListView.builder(
                          itemBuilder: ((context, index) {
                            final Jogador? jogador =
                                equipe.jogadores?[index];
                            final String apelido = jogador?.apelido != null
                                ? ' "${jogador?.apelido}"'
                                : "";
                            return Card(
                              elevation: 0.5,
                              shadowColor: Theme.of(context).shadowColor,
                              child: ListTile(
                                leading: Text(
                                  '${jogador?.numeroCamisa}',
                                  style:
                                      Theme.of(context).textTheme.headline6,
                                ),
                                title: Text(
                                  '${jogador?.nome}$apelido ${jogador?.sobrenome}',
                                  style:
                                      Theme.of(context).textTheme.bodyLarge,
                                ),
                                subtitle: Text('${jogador?.posicao}'),
                                trailing: const Icon(Icons.arrow_drop_up_outlined),
                              ),
                            );
                          }),
                          itemCount: equipe.jogadores?.length ?? 0,
                        ),
                      ),
                    ],
                  ),
                )
              ],
            ),
          ),
        ));
  }
}
