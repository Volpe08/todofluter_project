class Question{
  final String _question;
  final bool _isCorrect;

  Question(this._question, this._isCorrect);

  bool get isCorrect => _isCorrect;

  String get question => _question;


}