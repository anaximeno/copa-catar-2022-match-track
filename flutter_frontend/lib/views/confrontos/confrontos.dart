import 'package:flutter/foundation.dart';
import 'package:flutter/material.dart';
import 'package:http/http.dart' as http;
import '../../misc/assets.dart' as assets;
import '../../misc/configs.dart' as configs;
import 'dart:convert';
import 'confronto.dart';

List<Confronto> parseConfrontos(String responseBody) {
  final parsed = jsonDecode(responseBody).cast<Map<String, dynamic>>();
  return parsed.map<Confronto>((json) => Confronto.fromJSON(json)).toList();
}

Future<List<Confronto>> fetchConfrontos() async {
  final response =
      await http.get(Uri.parse('${configs.ipAddress}/api/v1/confrontos'));
  return compute(parseConfrontos, response.body);
}

class ViewConfrontos extends StatefulWidget {
  final Future<List<Confronto>> confrontos;

  const ViewConfrontos({super.key, required this.confrontos});

  @override
  State<ViewConfrontos> createState() => _ViewConfrontosState();
}

class _ViewConfrontosState extends State<ViewConfrontos> {
  _getOnTapCallback(BuildContext context, Confronto confronto) {
    return () {
      Navigator.of(context).push(
          MaterialPageRoute(builder: (context) => ViewConfronto(confronto)));
    };
  }

  @override
  Widget build(BuildContext context) {
    final int crossAxisCount = MediaQuery.of(context).size.width > 800 ? 2 : 1;

    return FutureBuilder<List<Confronto>>(
      future: widget.confrontos,
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
              gridDelegate: SliverGridDelegateWithFixedCrossAxisCount(
                crossAxisCount: crossAxisCount,
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
