import 'package:flutter/material.dart';
import 'package:flutter/rendering.dart';
import '../../misc/assets.dart' as assets;

class Jogador {
  final int id;
  final String nome;
  final String sobrenome;
  final String? apelido;
  final int idade;
  final int idEquipa;
  final String posicao;
  final int numeroCamisa;
  String? nomeDaEquipa;

  Jogador({
    required this.id,
    required this.nome,
    required this.sobrenome,
    required this.idade,
    required this.idEquipa,
    required this.posicao,
    required this.numeroCamisa,
    this.apelido,
    this.nomeDaEquipa,
  });

  factory Jogador.fromJSON(Map<String, dynamic> json) {
    return Jogador(
      id: json['id'],
      nome: json['nome'],
      sobrenome: json['sobrenome'],
      idade: json['idade'],
      idEquipa: json['id_equipa'],
      posicao: json['posicao'],
      numeroCamisa: json['numero_camisa'],
      apelido: json['apelido'],
    );
  }

  get nomeCompletoComApelido {
    final apelidoJogador = apelido != null ? '"$apelido"' : '';
    return '$nome $apelidoJogador $sobrenome';
  }

  get nomeCompleto {
    return '$nome $sobrenome';
  }
}

class ViewJogador extends StatefulWidget {
  final Jogador jogador;
  final double generalWidth;

  const ViewJogador({
    super.key,
    required this.jogador,
    this.generalWidth = 600,
  });

  @override
  State<ViewJogador> createState() => _ViewJogadorState();
}

class _ViewJogadorState extends State<ViewJogador> {
  Widget topDashGridElement({
    required BuildContext context,
    required String leading,
    required String title,
  }) {
    return Card(
      child: ListTile(
        leading: Text(leading),
        title: Text(
          title,
          style: Theme.of(context).textTheme.headline6,
        ),
      ),
    );
  }

  Widget topDash(BuildContext context) {
    return SingleChildScrollView(
      child: Center(
        child: Container(
          margin: const EdgeInsets.only(top: 20),
          child: ConstrainedBox(
            constraints: BoxConstraints(
              maxWidth: widget.generalWidth,
              maxHeight: 1000,
            ),
            child: GridView.count(
              crossAxisCount: 2,
              children: [
                Card(
                  child: SizedBox(
                    child: Image.asset(assets.imgJogadorDeFutebol),
                  ),
                ),
                ListView(
                  children: [
                    ListTile(
                      title: Text(
                        'Informações',
                        textAlign: TextAlign.center,
                        style: Theme.of(context).textTheme.headline5,
                      ),
                    ),
                    topDashGridElement(
                      context: context,
                      leading: 'Nome: ',
                      title: widget.jogador.nome,
                    ),
                    topDashGridElement(
                      context: context,
                      leading: 'Sobrenome: ',
                      title: widget.jogador.sobrenome,
                    ),
                    topDashGridElement(
                      context: context,
                      leading: 'Apelido: ',
                      title: widget.jogador.apelido ?? "Não Tem",
                    ),
                    topDashGridElement(
                      context: context,
                      leading: 'Equipa: ',
                      title: widget.jogador.nomeDaEquipa ?? "Sem Equipa",
                    ),
                    topDashGridElement(
                      context: context,
                      leading: 'Gols: ',
                      title: '#gols',
                    ), //TODO: get from class
                  ],
                )
              ],
            ),
          ),
        ),
      ),
    );
  }

  @override
  Widget build(BuildContext context) {
    return Scaffold(
      appBar: AppBar(
        title: const Text('Jogador'),
      ),
      body: SingleChildScrollView(
        child: topDash(context),
      ),
    );
  }
}
