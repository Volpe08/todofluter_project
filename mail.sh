echo "telnet smtp.univ-orleans.fr 25"
sleep 1
echo "HELO test.domaine.com"
sleep 1
FROM="test@domain.fr"
TO="toto@domain.com"
SUBJECT="test"
BODY="test"
echo HELO 'hostname'
sleep 1
echo "MAIL FROM:<"$FROM">"
sleep 1
echo "RCPT TO:<"$TO">"
sleep 1
echo DATA
echo Subject: $SUBJECT
echo $BODY
echo .
sleep 1
echo quit