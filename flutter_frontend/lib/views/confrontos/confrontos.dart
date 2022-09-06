import 'package:flutter/foundation.dart';
import 'package:flutter/material.dart';
import 'package:http/http.dart' as http;
import 'dart:convert';
import 'confronto.dart';

List<Confronto> parseConfrontos(String responseBody) {
  final parsed = jsonDecode(responseBody).cast<Map<String, dynamic>>();
  return parsed.map<Confronto>((json) => Confronto.fromJSON(json)).toList();
}

Future<List<Confronto>> fetchConfrontos() async {
  final response =
      await http.get(Uri.parse('http://0.0.0.0:8000/api/v1/confrontos'));
  return compute(parseConfrontos, response.body);
}

class ViewConfrontos extends StatefulWidget {
  const ViewConfrontos({super.key});

  @override
  State<ViewConfrontos> createState() => _ViewConfrontosState();
}

class _ViewConfrontosState extends State<ViewConfrontos> {
  late Future<List<Confronto>> _confrontos;

  @override
  void initState() {
    super.initState();
    _confrontos = fetchConfrontos();
  }

  @override
  Widget build(BuildContext context) {
    return FutureBuilder<List<Confronto>>(
      future: _confrontos,
      builder: (context, snapshot) {
        if (snapshot.hasData) {
          final confrontos = snapshot.data!;

          return ListView.builder(
            itemCount: confrontos.length,
            itemBuilder: ((context, index) {
              return ListTile(
                leading: const Icon(Icons.sports_soccer_outlined),
                title: Text(
                  '${confrontos[index].equipaCasa.nome} VS ${confrontos[index].equipaVisita.nome}',
                ),
                subtitle: Text(
                  'Dia ${confrontos[index].dia} em ${confrontos[index].local} no estadio ${confrontos[index].estadio}',
                ),
              );
            }),
          );
        } else if (snapshot.hasError) {
          return Text('${snapshot.error}');
        }

        return const CircularProgressIndicator();
      },
    );
  }
}
