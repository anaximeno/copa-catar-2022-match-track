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
      apelido: json['apelido']
    );
  }
}
