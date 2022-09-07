import 'package:flutter/foundation.dart';
import 'package:flutter/material.dart';
import 'package:http/http.dart' as http;
import '../../misc/assets.dart' as assets;
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

  _getOnTapCallback(BuildContext context, Confronto confronto) {
    return () {
      Navigator.of(context).push(
          MaterialPageRoute(builder: (context) => ViewConfronto(confronto)));
    };
  }

  @override
  Widget build(BuildContext context) {
    return FutureBuilder<List<Confronto>>(
      future: _confrontos,
      builder: (context, snapshot) {
        if (snapshot.hasData) {
          final confrontos = snapshot.data!;
          const colorsList = [
            Colors.red,
            Colors.blue,
            Colors.amber,
            Colors.green,
            Colors.pink,
            Colors.orange,
            Colors.teal,
          ];

          return SizedBox(
            width: 800,
            child: GridView.builder(
              gridDelegate: const SliverGridDelegateWithFixedCrossAxisCount(
                crossAxisCount: 2,
              ),
              itemCount: confrontos.length,
              itemBuilder: ((context, index) {
                return MouseRegion(
                  cursor: SystemMouseCursors.click,
                  child: GestureDetector(
                    onTap: _getOnTapCallback(context, confrontos[index]),
                    child: Container(
                      width: 200,
                      height: 200,
                      margin: const EdgeInsets.all(8),
                      child: SizedBox(
                        child: Column(
                          children: [
                            Card(
                              clipBehavior: Clip.antiAlias,
                              elevation: 1.1,
                              child: Image.asset(assets.imgEstadioDeFutebol),
                            ),
                            Card(
                              elevation: 1.1,
                              child: Column(
                                children: [
                                  ListTile(
                                    onTap: _getOnTapCallback(
                                      context,
                                      confrontos[index],
                                    ),
                                    leading: Icon(
                                      Icons.sports_soccer_outlined,
                                      color:
                                          colorsList[index % colorsList.length],
                                    ),
                                    title: Text(
                                      '${confrontos[index].equipaCasa.nome} VS ${confrontos[index].equipaVisita.nome}',
                                    ),
                                    subtitle: Text(
                                      'Dia ${confrontos[index].dia} em ${confrontos[index].local} no estadio ${confrontos[index].estadio}',
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
              }),
            ),
          );
        } else if (snapshot.hasError) {
          return Text('${snapshot.error}');
        }

        return const CircularProgressIndicator();
      },
    );
  }
}
