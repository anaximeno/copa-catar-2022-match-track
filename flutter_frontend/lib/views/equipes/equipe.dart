import 'package:http/http.dart' as http;
import 'dart:convert';

class Equipe {
  final int id;
  final String nome;
  final String localPertencente;

  const Equipe({
    required this.id,
    required this.nome,
    required this.localPertencente,
  });

  factory Equipe.fromJSON(Map<String, dynamic> json) {
    return Equipe(
      id: json['id'],
      nome: json['nome'],
      localPertencente: json['local_pertencente'],
    );
  }
}

Future<Equipe> fetchEquipe({required final int id}) async {
  final response =
      await http.get(Uri.parse('http://0.0.0.0:8000/api/v1/equipes/$id'));

  if (response.statusCode == 200) {
    return Equipe.fromJSON(jsonDecode(response.body));
  } else {
    throw Exception('Failed to load album');
  }
}
