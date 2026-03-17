var keySize = 128;
var iterations = iterationCount = 10000;

var iv = "LJ2390JF0EWJ09F20R3IFS0EIVSSD0IC";
var salt = "239RMC2039RF02Q3EFIJEI48GTREODVS9ZCJU9EV8GER9U5GH934WHGV9DESHF9E";
var passPhrase = "SNAKEDICEPASSPHRASE";
 
var plainText = "AES:ENCODING: ALGORITHM =>PLAIN TEXT";

var aesUtil = new AesUtil(keySize, iterationCount)
var encrypt = aesUtil.encrypt(salt, iv, passPhrase, plainText);
 
 aesUtil = new AesUtil(keySize, iterationCount)
 var decrypt = aesUtil.decrypt(salt, iv, passPhrase, encrypt);
