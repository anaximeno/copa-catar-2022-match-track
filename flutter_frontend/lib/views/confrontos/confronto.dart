import '../equipes/equipe.dart';
import 'package:http/http.dart' as http;
import 'dart:convert';


class Confronto {
  final int id;
  final String local;
  final String dia;
  final String inicio;
  final String fim;
  final String estadio;
  final String rodada;
  Future<Equipe> equipeCasa;
  Future<Equipe> equipeVisita;
  final bool terminou;

  Confronto({
    required this.id,
    required this.local,
    required this.dia,
    required this.inicio,
    required this.fim,
    required this.estadio,
    required this.rodada,
    required this.terminou,
    required this.equipeCasa,
    required this.equipeVisita,
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
      terminou: json['terminou'],
      equipeCasa: fetchEquipe(id: json['id_equipa_casa']),
      equipeVisita: fetchEquipe(id: json['id_equipa_visita']),
    );
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
