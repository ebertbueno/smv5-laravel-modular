function Admin() {
    var nome;

    this.getNome = function () {
        return nome;
    };

    this.setNome = function (value) {
        nome = value;
    };
}