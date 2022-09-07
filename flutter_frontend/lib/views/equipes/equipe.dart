import 'package:flutter/material.dart';
import 'package:flutter_frontend/views/jogadores/jogador.dart';
import 'package:http/http.dart' as http;
import '../../misc/assets.dart' as assets;
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

  Widget gridDashSection(BuildContext context, int stat, String title) {
    return Card(
      child: Column(
        crossAxisAlignment: CrossAxisAlignment.center,
        mainAxisAlignment: MainAxisAlignment.spaceEvenly,
        children: [
          Text(
            '$stat',
            style: Theme.of(context).textTheme.headline3,
          ),
          Text(
            title,
            style: Theme.of(context).textTheme.headline5,
          )
        ],
      ),
    );
  }

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
                    child: Text(
                      equipe.nome,
                      style: Theme.of(context).textTheme.headline4,
                      textAlign: TextAlign.center,
                    ),
                  ),
                ),
                SizedBox(
                  width: 400,
                  child: Card(
                    child: Image.asset(
                      assets.imgClubeDeFutebol,
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
                      gridDashSection(
                          context, equipe.numberOfGols ?? 0, 'Gols'),
                      gridDashSection(context,
                          equipe.numberOfSubstituicoes ?? 0, 'Substituições'),
                      gridDashSection(
                          context, equipe.numberOfJogadores ?? 0, 'Jogadores'),
                      gridDashSection(
                          context, equipe.numberOfCartoes ?? 0, 'Cartões'),
                    ],
                  ),
                ),
                Card(
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
                            final Jogador? jogador = equipe.jogadores?[index];
                            return Card(
                              elevation: 0.5,
                              color: Theme.of(context).backgroundColor,
                              shadowColor: Theme.of(context).shadowColor,
                              child: ListTile(
                                onTap: () {
                                  if (jogador != null) {
                                    Navigator.of(context).push(
                                      MaterialPageRoute(
                                        builder: (context) =>
                                            ViewJogador(jogador: jogador),
                                      ),
                                    );
                                  }
                                },
                                leading: Text(
                                  '${jogador?.numeroCamisa}',
                                  style: Theme.of(context).textTheme.headline6,
                                ),
                                title: Text(
                                  '${jogador?.nomeCompletoComApelido}',
                                  style: Theme.of(context).textTheme.bodyLarge,
                                ),
                                subtitle: Text('${jogador?.posicao}'),
                                trailing:
                                    const Icon(Icons.arrow_drop_up_outlined),
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
