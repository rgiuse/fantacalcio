# Fantacalcio

Un vecchio progetto personale per la gestione del fantacalcio, è stato portato poi in una sua versione embrionale come progetto di un esame universitario.

## Caratteristiche Tecniche

- **Linguaggio principale**: PHP
- **Layout**: Utilizza le table per il layout (cosa normale dell'epoca)
- **Deploy**: Apache con database MySQL
- **Forum integrato**: [phpBB](phpBB2/) con rudimentale Single Sign On (necessitava della creazione manuale dell'utente su phpBB)
- **Versione mobile**: Sviluppo abbozzato della versione WAP dell'epoca in WML, visibile in [`index.php`](index.php)
- **Messaggistica**: Funzionalità di messaggistica interna al sito

## Note Storiche

- MySQL all'epoca non supportava le query annidate
- **Nota sulla sicurezza**: Pessima gestione delle password in chiaro su DB (cosa molto comune all'epoca)

## Licenza

Questo progetto è rilasciato sotto [licenza MIT](LICENSE).
