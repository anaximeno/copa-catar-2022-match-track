import 'package:flutter/material.dart';
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
  int? nGols;
  int? nCartoes;

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
    this.nGols,
    this.nCartoes,
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
      nGols: json['gols']?.length,
      nCartoes: json['cartoes']?.length,
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
    this.generalWidth = 500,
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
        trailing: Text(
          title,
          style: TextStyle(
            fontSize: Theme.of(context).textTheme.headline6?.fontSize,
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
      body: Center(
        child: SizedBox(
          width: widget.generalWidth,
          child: ListView(
            children: [
              Card(
                child: ListTile(
                  leading: Text(
                    '${widget.jogador.numeroCamisa}',
                    style: Theme.of(context).textTheme.headline5,
                  ),
                  title: Text(
                    widget.jogador.nomeCompletoComApelido,
                    style: Theme.of(context).textTheme.headline6,
                  ),
                  subtitle: Text(
                    widget.jogador.posicao,
                  ),
                ),
              ),
              Card(
                child: Image.asset(assets.imgJogadorDeFutebol, scale: 1.2),
              ),
              ListTile(
                title: Text(
                  'Informa????es',
                  textAlign: TextAlign.center,
                  style: Theme.of(context).textTheme.headline5,
                ),
              ),
              topDashGridElement(
                context: context,
                leading: 'N??mero',
                title: '${widget.jogador.numeroCamisa}',
              ),
              topDashGridElement(
                context: context,
                leading: 'Nome',
                title: widget.jogador.nome,
              ),
              topDashGridElement(
                context: context,
                leading: 'Sobrenome',
                title: widget.jogador.sobrenome,
              ),
              topDashGridElement(
                context: context,
                leading: 'Apelido',
                title: widget.jogador.apelido ?? "N??o Tem",
              ),
              topDashGridElement(
                context: context,
                leading: 'Idade',
                title: '${widget.jogador.idade}',
              ),
              topDashGridElement(
                context: context,
                leading: 'Equipa',
                title: widget.jogador.nomeDaEquipa ?? "Sem Equipa",
              ),
              topDashGridElement(
                context: context,
                leading: 'Posi????o',
                title: widget.jogador.posicao,
              ),
              topDashGridElement(
                context: context,
                leading: 'Gols',
                title: '${widget.jogador.nGols ?? 0}',
              ),
              topDashGridElement(
                context: context,
                leading: 'Cart??es',
                title: '${widget.jogador.nCartoes ?? 0}',
              ),
            ],
          ),
        ),
      ),
    );
  }
}
