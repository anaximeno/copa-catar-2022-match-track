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

  Jogador({
    required this.id,
    required this.nome,
    required this.sobrenome,
    required this.idade,
    required this.idEquipa,
    required this.posicao,
    required this.numeroCamisa,
    this.apelido,
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
        apelido: json['apelido']);
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

  const ViewJogador({
    super.key,
    required this.jogador,
  });

  @override
  State<ViewJogador> createState() => _ViewJogadorState();
}

class _ViewJogadorState extends State<ViewJogador> {
  Widget topDash(BuildContext context) {
    return Row(
      children: [
        Card(
          child: Image.asset(assets.imgJogadorDeFutebol),
        )
      ],
    );
  }

  @override
  Widget build(BuildContext context) {
    return Scaffold(
      appBar: AppBar(
        title: Text(
          widget.jogador.nomeCompleto,
        ),
      ),
    );
  }
}
