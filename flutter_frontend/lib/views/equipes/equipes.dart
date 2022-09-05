import 'package:flutter/foundation.dart';
import 'package:flutter/material.dart';
import 'package:http/http.dart' as http;
import 'dart:convert';
import 'equipe.dart';

List<Equipe> parseEquipes(String responseBody) {
  final parsed = jsonDecode(responseBody).cast<Map<String, dynamic>>();
  return parsed.map<Equipe>((json) => Equipe.fromJSON(json)).toList();
}

Future<List<Equipe>> fetchEquipes() async {
  final response =
      await http.get(Uri.parse('http://0.0.0.0:8000/api/v1/equipes'));
  return compute(parseEquipes, response.body);
}

class EquipesList extends StatelessWidget {
  final List<Equipe> equipes;

  const EquipesList({super.key, required this.equipes});

  @override
  Widget build(BuildContext context) {
    return GridView.builder(
      gridDelegate:
          const SliverGridDelegateWithFixedCrossAxisCount(crossAxisCount: 2),
      itemCount: equipes.length,
      itemBuilder: (context, index) => Text(equipes[index].nome),
    );
  }
}

class ViewEquipes extends StatefulWidget {
  const ViewEquipes({super.key});

  @override
  State<ViewEquipes> createState() => _ViewEquipesState();
}

class _ViewEquipesState extends State<ViewEquipes> {
  late Future<List<Equipe>> futureEquipes;

  @override
  void initState() {
    super.initState();
    futureEquipes = fetchEquipes();
  }

  @override
  Widget build(BuildContext context) {
    return FutureBuilder<List<Equipe>>(
      future: futureEquipes,
      builder: (context, snapshot) {
        if (snapshot.hasData) {
          return EquipesList(equipes: snapshot.data!);
        } else if (snapshot.hasError) {
          return Text('${snapshot.error}');
        }

        return const CircularProgressIndicator();
      },
    );
  }
}
