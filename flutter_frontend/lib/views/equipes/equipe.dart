import 'package:flutter/gestures.dart';
import 'package:flutter/material.dart';
import 'package:flutter_frontend/views/jogadores/jogador.dart';
import 'package:http/http.dart' as http;
import '../../misc/assets.dart' as assets;
import '../../misc/configs.dart' as configs;
import 'dart:convert';

class Equipe {
  final int id;
  final String nome;
  final String localPertencente;
  final int? numberOfGols;
  final int? numberOfCartoes;
  final int? numberOfSubstituicoes;
  final int? nJogadores;
  final List<Jogador>? jogadores;

  const Equipe(
      {required this.id,
      required this.nome,
      required this.localPertencente,
      this.numberOfGols,
      this.numberOfCartoes,
      this.numberOfSubstituicoes,
      this.jogadores,
      this.nJogadores});

  factory Equipe.fromJSON(Map<String, dynamic> json) {
    //FIXME: error when trying to get list of jogadores em json['jogadores_em_campo']

    final jogadores = json['jogadores']
        ?.map<Jogador>((json) => Jogador.fromJSON(json))
        .toList();

    final nJogadores =
        (json['jogadores'] ?? json['jogadores_em_campo'])?.length;

    return Equipe(
        id: json['id'],
        nome: 'F.C. ${json['nome']}',
        localPertencente: json['local_pertencente'],
        numberOfGols: json['gols']?.length,
        numberOfCartoes: json['cartoes']?.length,
        numberOfSubstituicoes: json['substituicoes']?.length,
        jogadores: jogadores,
        nJogadores: nJogadores);
  }

  get numberOfJogadores {
    return jogadores?.length;
  }
}

Future<Equipe> fetchEquipe({required final int id}) async {
  final response = await http.get(Uri.parse('${configs.ipAddress}/api/v1/equipes/$id'));

  if (response.statusCode == 200) {
    return Equipe.fromJSON(jsonDecode(response.body));
  } else {
    throw Exception('Failed to load equipe');
  }
}

class ViewEquipe extends StatelessWidget {
  final Equipe equipe;
  // XXX: Convert this class to a mutable class
  // and then use this to resize this section?
  final double generalWidth;

  const ViewEquipe({
    super.key,
    required this.equipe,
    this.generalWidth = 400,
  });

  Widget gridDashSection({
    required BuildContext context,
    required int stat,
    required String title,
  }) {
    return Card(
      child: Column(
        crossAxisAlignment: CrossAxisAlignment.center,
        mainAxisAlignment: MainAxisAlignment.spaceEvenly,
        children: [
          Text('$stat', style: Theme.of(context).textTheme.headline3),
          Text(title, style: Theme.of(context).textTheme.headline5)
        ],
      ),
    );
  }

  @override
  Widget build(BuildContext context) {
    return Scaffold(
        appBar: AppBar(
          title: const Text('Equipe'),
        ),
        body: SingleChildScrollView(
          dragStartBehavior: DragStartBehavior.start,
          child: Center(
            child: Column(
              children: [
                SizedBox(
                  width: generalWidth,
                  child: Card(
                    child: Text(
                      equipe.nome,
                      style: Theme.of(context).textTheme.headline4,
                      textAlign: TextAlign.center,
                    ),
                  ),
                ),
                SizedBox(
                  width: generalWidth,
                  child: Card(
                    child: Image.asset(
                      assets.imgClubeDeFutebol,
                      scale: 1.2,
                    ),
                  ),
                ),
                SizedBox(
                  width: generalWidth,
                  height: generalWidth,
                  child: GridView.count(
                    physics: const NeverScrollableScrollPhysics(),
                    crossAxisCount: 2,
                    children: [
                      gridDashSection(
                        context: context,
                        stat: equipe.numberOfGols ?? 0,
                        title: 'Gols',
                      ),
                      gridDashSection(
                        context: context,
                        stat: equipe.numberOfSubstituicoes ?? 0,
                        title: 'Substitui????es',
                      ),
                      gridDashSection(
                        context: context,
                        stat: equipe.numberOfJogadores ?? 0,
                        title: 'Jogadores',
                      ),
                      gridDashSection(
                        context: context,
                        stat: equipe.numberOfCartoes ?? 0,
                        title: 'Cart??es',
                      ),
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
                        constraints: BoxConstraints(
                          maxWidth: generalWidth,
                          maxHeight: 80.0 * (equipe.jogadores?.length ?? 0),
                        ),
                        child: ListView.builder(
                          physics: const NeverScrollableScrollPhysics(),
                          itemBuilder: ((context, index) {
                            final Jogador? jogador = equipe.jogadores?[index];
                            return Card(
                              elevation: 0.5,
                              color: Theme.of(context).backgroundColor,
                              shadowColor: Theme.of(context).shadowColor,
                              child: ListTile(
                                onTap: () {
                                  if (jogador != null) {
                                    jogador.nomeDaEquipa = equipe.nome;
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
