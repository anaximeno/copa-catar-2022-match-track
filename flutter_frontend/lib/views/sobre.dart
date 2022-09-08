import 'package:flutter/material.dart';

const descriptionText = """
Aplicação fullstack estruturada a apresentar jogos da copa do mundo de futebol de 2022 em Catar.

O frontend é feito completamente usando a framework Flutter com a linguagem de programação Dart, e o backend
usando o framework Laravel para a linguagem de programação PHP.
""";

const version = '0.8.0';

const author = 'Anaxímeno Brito';

class ViewSobre extends StatelessWidget {
  final double generalWidth;

  const ViewSobre({super.key, this.generalWidth = 600});

  @override
  Widget build(BuildContext context) {
    return Center(
      child: SizedBox(
        width: generalWidth,
        child: Flex(
          direction: Axis.vertical,
          children: [
            Container(
              margin: const EdgeInsets.only(top: 20),
              child: Column(
                children: [
                  Text(
                    'Copa Catar 2022 - Match Tracker',
                    style: Theme.of(context).textTheme.headline4,
                  ),
                  Text(
                    'Versão $version',
                    style: Theme.of(context).textTheme.bodySmall,
                  ),
                ],
              ),
            ),
            Expanded(
              child: Container(
                margin: const EdgeInsets.only(top: 40),
                child: Text(
                  descriptionText,
                  style: Theme.of(context).textTheme.headline6,
                  textAlign: TextAlign.center,
                ),
              ),
            ),
            Expanded(
              child: Center(
                child: Text(
                  'Autor: $author',
                  style: Theme.of(context).textTheme.bodySmall,
                ),
              ),
            )
          ],
        ),
      ),
    );
  }
}
