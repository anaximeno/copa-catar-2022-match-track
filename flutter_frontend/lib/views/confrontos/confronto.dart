import 'package:flutter/material.dart';
import '../equipes/equipe.dart';
import 'package:http/http.dart' as http;
import '../../misc/assets.dart' as assets;
import '../../misc/configs.dart' as configs;
import 'dart:convert';

class Arbitro {
  final int id;
  final String nome;
  final String sobrenome;
  final int idade;

  Arbitro({
    required this.id,
    required this.nome,
    required this.sobrenome,
    required this.idade,
  });

  factory Arbitro.fromJSON(Map<String, dynamic> json) {
    return Arbitro(
      id: json['id'],
      nome: json['nome'],
      sobrenome: json['sobrenome'],
      idade: json['idade'],
    );
  }

  get nomeCompleto {
    return '$nome $sobrenome';
  }
}

class Confronto {
  final int id;
  final String local;
  final String dia;
  final String inicio;
  final String fim;
  final String estadio;
  final String rodada;
  final bool terminou;
  final Equipe equipaCasa;
  final Equipe equipaVisita;
  final Arbitro arbitro;

  Confronto({
    required this.id,
    required this.local,
    required this.dia,
    required this.inicio,
    required this.fim,
    required this.estadio,
    required this.rodada,
    required this.terminou,
    required this.equipaCasa,
    required this.equipaVisita,
    required this.arbitro,
  });

  factory Confronto.fromJSON(Map<String, dynamic> json) {
    return Confronto(
        id: json['id'],
        local: json['local'],
        dia: json['dia'],
        inicio: json['inicio'],
        fim: json['fim'],
        estadio: json['estadio'],
        rodada: json['rodada'],
        terminou: json['terminou'] == 0 ? false : true,
        equipaCasa: Equipe.fromJSON(json['equipes']['casa']),
        equipaVisita: Equipe.fromJSON(json['equipes']['visita']),
        arbitro: Arbitro.fromJSON(json['arbitro']));
  }
}

Future<Confronto> fetchConfronto({required final int id}) async {
  final response =
      await http.get(Uri.parse('${configs.ipAddress}/api/v1/confrontos/$id'));

  if (response.statusCode == 200) {
    return Confronto.fromJSON(jsonDecode(response.body));
  } else {
    throw Exception('Failed to load confronto');
  }
}

class ViewConfronto extends StatefulWidget {
  final Confronto confronto;
  final double generalWidth;

  const ViewConfronto(this.confronto, {super.key, this.generalWidth = 600});

  @override
  State<ViewConfronto> createState() => _ViewConfrontoState();
}

class _ViewConfrontoState extends State<ViewConfronto> {
  Widget presentEquipeEmConfronto(
    Equipe equipe, {
    required BuildContext context,
    required Widget? leading,
    required Widget? title,
    required Widget? subtitle,
    required Widget? trailing,
  }) {
    return SizedBox(
      width: widget.generalWidth / 2,
      height: 300,
      child: Card(
        child: ListView(children: [
          Card(
            child: ListTile(
              leading: leading,
              title: title,
              subtitle: subtitle,
              trailing: trailing,
            ),
          ),
          Card(
            elevation: 0,
            child: ListTile(
              title: const Text('Jogadores'),
              trailing: Text('${equipe.nJogadores ?? 0}'),
            ),
          ),
          Card(
            elevation: 0,
            child: ListTile(
              title: const Text('Cartões'),
              trailing: Text('${equipe.numberOfCartoes ?? 0}'),
            ),
          ),
          Card(
            elevation: 0,
            child: ListTile(
              title: const Text('Substituições'),
              trailing: Text('${equipe.numberOfSubstituicoes ?? 0}'),
            ),
          ),
        ]),
      ),
    );
  }

  @override
  Widget build(BuildContext context) {
    final Confronto confronto = widget.confronto;

    return Scaffold(
      appBar: AppBar(
        title: const Text('Confronto'),
      ),
      body: SingleChildScrollView(
        child: Center(
          child: SizedBox(
            width: widget.generalWidth,
            child: Column(
              children: [
                Card(
                  child: ListTile(
                    title: Text(
                      '${confronto.equipaCasa.nome} VS ${confronto.equipaVisita.nome}',
                      style: Theme.of(context).textTheme.headline5,
                      textAlign: TextAlign.center,
                    ),
                  ),
                ),
                Card(
                  child: Image.asset(assets.imgEstadioDeFutebol),
                ),
                Card(
                  child: ListTile(
                      leading: const Icon(Icons.sports),
                      title: Text(confronto.arbitro.nomeCompleto),
                      subtitle: Text('Tem ${confronto.arbitro.idade} anos'),
                      trailing: const Text('Arbitro Principal')),
                ),
                SizedBox(
                  width: widget.generalWidth,
                  height: 400,
                  child: GridView.count(
                    crossAxisCount: 2,
                    children: [
                      presentEquipeEmConfronto(
                        confronto.equipaCasa,
                        context: context,
                        leading: Image.asset(assets.imgClubeDeFutebol),
                        title: Text(confronto.equipaCasa.nome),
                        trailing: Text(
                          '${confronto.equipaCasa.numberOfGols ?? 0}',
                          style: Theme.of(context).textTheme.headline4,
                        ),
                        subtitle: const Text('Casa'),
                      ),
                      presentEquipeEmConfronto(
                        confronto.equipaVisita,
                        context: context,
                        leading: Text(
                          '${confronto.equipaVisita.numberOfGols ?? 0}',
                          style: Theme.of(context).textTheme.headline4,
                        ),
                        title: Text(
                          confronto.equipaVisita.nome,
                          textAlign: TextAlign.end,
                        ),
                        trailing: Image.asset(assets.imgClubeDeFutebol),
                        subtitle: const Text(
                          'Visita',
                          textAlign: TextAlign.end,
                        ),
                      ),
                    ],
                  ),
                ),
              ],
            ),
          ),
        ),
      ),
    );
  }
}
