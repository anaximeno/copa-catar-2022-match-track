import 'package:flutter/material.dart';
import '../equipes/equipe.dart';
import 'package:http/http.dart' as http;
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
      arbitro: Arbitro.fromJSON(json['arbitro']),
    );
    // TODO: add cartões, gols, e substituições
  }
}

Future<Confronto> fetchConfronto({required final int id}) async {
  final response =
      await http.get(Uri.parse('http://0.0.0.0:8000/api/v1/confrontos/$id'));

  if (response.statusCode == 200) {
    return Confronto.fromJSON(jsonDecode(response.body));
  } else {
    throw Exception('Failed to load confronto');
  }
}

class ViewConfronto extends StatelessWidget {
  final Confronto confronto;

  const ViewConfronto(this.confronto, {super.key});

  @override
  Widget build(BuildContext context) {
    return Scaffold(
      appBar: AppBar(
        title: Text(
          '${confronto.equipaCasa.nome} VS ${confronto.equipaVisita.nome}',
        ),
      ),
    );
  }
}
