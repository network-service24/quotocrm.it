<?php
        include($_SERVER['DOCUMENT_ROOT'].'/v2/include/settings.inc.php');

        
        $username   = DB_SUITEWEB_USER;
        $password   = DB_SUITEWEB_PASSWORD;
        $host       = DB_SUITEWEB_HOST;
        $dbname     = DB_SUITEWEB_NAME;

        $usernameQ   = DB_USER;
        $passwordQ   = DB_PASSWORD;
        $hostQ       = HOST;
        $dbnameQ     = DATABASE;


        require_once($_SERVER['DOCUMENT_ROOT'].'/v2/class/MysqliDb.php');
        
        
        $db_suiteweb = new MysqliDb($host, $username, $password, $dbname);
        $db_quoto    = new MysqliDb($hostQ, $usernameQ, $passwordQ, $dbnameQ);

      if($_REQUEST['idsito']){

         $query = "SELECT siti.idsito, siti.nome, siti.web,siti.https
                     FROM siti
                     WHERE siti.idsito = ".$_REQUEST['idsito']."
                     GROUP BY siti.idsito";
            $rec = $db_suiteweb->query($query);
            $v = $rec[0];
            $sito_tmp    = str_replace("http://","",$v['web']);
            $sito_tmp    = str_replace("https://","",$sito_tmp);
            //$sito_tmp    = str_replace("www.","",$sito_tmp);

            //$SitoWeb   = '//'.$sito_tmp;  

            $EtichettaMenu   = 'Misure anti COVID-19';

            $Titolo     = 'CI PRENDIAMO CURA DI TE!<br>Scopri i nuovi accorgimenti per le tue vacanze!';
            $Testo      = 'Ecco la risposta di '.$v['nome'].' per garantire soggiorni ancor più sicuri e sereni!
                                <br><br>
                                Senza rinunciare al piacere di un soggiorno all\'insegna del relax e del divertimento, in perfetto stile '.$v['nome'].'.
                                <br><br>
                                Abbiamo riesaminato molti aspetti della nostra ospitalità, in modo da poter garantire che ogni momento di un soggiorno all\' '.$v['nome'].' possa essere un\'esperienza piacevole e sicura.<br><br>La sicurezza e la serenità dei nostri Ospiti vengono al primo posto.
                                <br><br>
                                Alcuni dei nostri accorgimenti riguardano ad esempio:
                                <br><br>
                                <b>Formazione del personale</b><br>
                                Un addestramento specifico per tutto il nostro staff, mirato a ridurre al massimo ogni possibilità di contagio
                                <br><br>
                                <b>Certificazione del personale</b><br>
                                Monitoraggio periodico dello stato di salute del nostro staff e del loro stato di immunizzazione
                                <br><br>
                                <b>Breakfast</b> <br>
                                Un servizio organizzato in modo da garantire il distanziamento adeguato ed evitare la contaminazione
                                <br><br>
                                <b>Ristorante</b> <br>
                                Un servizio accurato e attento, in cui ogni pietanza sarà servita al tavolo, mantenendo la massima qualità dei nostri piatti gourmet.
                                <br><br>
                                <b>Sanificazione della camera</b><br> 
                                Alla pulizia tradizionale si aggiungerà una sanificazione speciale di ogni superficie, eseguita quotidianamente, per offrire la massima garanzia. Il lavaggio e la disinfezione della biancheria saranno certificati.
                                <br><br>
                                <b>Sanificazione della Spa e della Piscina</b> <br>
                                Gli ambienti comuni dedicati al relax e al benessere saranno gestiti in modo da offrire un distanziamento maggiori ed una sanificazione continua
                                <br><br>
                                <b>Nuovi servizi e opportunità</b> <br>
                                Dalla cena vista mare sul balcone della propria camera al room service per il breakfast: tutti i servizi in camera saranno su misura e senza supplemento
                                <br><br>
                                <b>Procedure semplificate</b> <br>
                                Per il check-in ed il check-out gran parte delle operazioni amministrative potranno essere effettuate online, limitando al massimo il contatto fisico
                                <br><br>
                                <b>Prenotazioni più flessibili</b> <br>
                                Maggior libertà nella scelta delle date di soggiorno e nella possibilità di spostare la propria prenotazione senza penali
                                <br><br>
                                <b>Spiaggia con più spazio a disposizione</b><br>
                                Maggior distanza tra gli ombrelloni, per offrire maggior confort e garantire il maggior distanziamento
                                <br><br>
                                <b>Posto auto in garage gratuito</b> <br>
                                Un plus dedicato a chi preferirà spostarsi in auto, evitando i mezzi pubblici';

            $TitoloENG      = 'WE TAKE CARE OF YOU! <br> Discover the new arrangements for your holidays!';
            $TestoENG       = 'Here is the answer for '.$v['nome'].' to ensure even safer and more peaceful stays!
                                    <br><br>
                                        Without giving up the pleasure of a stay of relaxation and fun, in perfect style '.$v['nome'].'.
                                        <br><br>
                                        We have reviewed many aspects of our hospitality, so that we can ensure that every moment of your stay at '.$v['nome'].' can be a pleasant and safe experience. <br> <br> The safety and serenity of our Guests come first.
                                        <br><br>
                                        Some of our measures concern for example:
                                        <br><br>
                                        <b> Staff training </b> <br>
                                        Specific training for all our staff, aimed at minimizing any possibility of contagion
                                        <br>
                                        <b> Staff certification </b> <br>
                                        Periodic monitoring of the health status of our staff and their immunization status
                                        <br>
                                        <b> Breakfast </b> <br>
                                        A service organized so as to guarantee adequate spacing and avoid contamination
                                        <br>
                                        <b> Restaurant </b> <br>
                                        An accurate and attentive service, in which every dish will be served at the table, maintaining the highest quality of our gourmet dishes.
                                        <br>
                                        <b> Room sanitization </b> <br>
                                        To the traditional cleaning, a special sanitization of each surface will be added, carried out daily, to offer maximum guarantee. The washing and disinfection of the linen will be certified.
                                        <br>
                                        <b> Sanitization of the Spa and the Pool </b> <br>
                                        The common areas dedicated to relaxation and well-being will be managed so as to offer greater distancing and continuous sanitization
                                        <br>
                                        <b> New services and opportunities </b> <br>
                                        From the sea view dinner on the balcony of your room to the room service for breakfast: all room services will be made to measure and without supplement
                                        <br>
                                        <b> Simplified procedures </b> <br>
                                        For check-in and check-out most of the administrative operations can be carried out online, limiting physical contact as much as possible
                                        <br>
                                        <b> More flexible reservations </b> <br>
                                        Greater freedom in choosing the dates of stay and in the possibility of moving your booking without penalty
                                        <br>
                                        <b> Beach with more space available </b> <br>
                                        Greater distance between the umbrellas, to offer greater comfort and guarantee greater distance
                                        <br>
                                        <b> Free garage parking space </b> <br>
                                        A plus dedicated to those who prefer to travel by car, avoiding public transport';


            $TitoloFRA      = 'NOUS PRENONS SOIN DE VOUS! <br> Découvrez les nouveaux arrangements pour vos vacances!';
            $TestoFRA       = 'Voici la réponse pour '.$v['nome'].' pour assurer des séjours encore plus sûrs et plus paisibles!
                                    <br><br>
                                    Sans renoncer au plaisir d\'un séjour de détente et de plaisir, dans un style parfait '.$v['nome'].'.
                                    <br><br>
                                    Nous avons passé en revue de nombreux aspects de notre hospitalité, afin que nous puissions nous assurer que chaque instant de votre séjour au '.$v['nome'].' peut être une expérience agréable et sûre. <br> <br> La sécurité et la sérénité de nos clients passent avant tout.
                                    <br><br>
                                    Certaines de nos mesures concernent par exemple:
                                    <br><br>
                                    <b> Formation du personnel </b> <br>
                                    Formation spécifique pour tout notre personnel, visant à minimiser toute possibilité de contagion
                                    <br>
                                    <b> Certification du personnel </b> <br>
                                    Suivi périodique de l\'état de santé de nos collaborateurs et de leur statut vaccinal
                                    <br>
                                    <b> Petit déjeuner </b> <br>
                                    Un service organisé pour garantir un espacement adéquat et éviter les contaminations
                                    <br>
                                    <b> Restaurant </b> <br>
                                    Un service précis et attentionné, dans lequel chaque plat sera servi à table, en maintenant la plus haute qualité de nos plats gastronomiques.
                                    <br>
                                    <b> Assainissement de la pièce </b> <br>
                                    Au nettoyage traditionnel, une désinfection spéciale de chaque surface sera ajoutée, effectuée quotidiennement, pour offrir une garantie maximale. Le lavage et la désinfection du linge seront certifiés.
                                    <br>
                                    <b> Assainissement du spa et de la piscine </b> <br>
                                    Les espaces communs dédiés à la détente et au bien-être seront gérés de manière à offrir une plus grande distance et une hygiène continue
                                    <br>
                                    <b> Nouveaux services et opportunités </b> <br>
                                    Du dîner vue mer sur le balcon de votre chambre au room service pour le petit déjeuner: tous les services en chambre seront faits sur mesure et sans supplément
                                    <br>
                                    <b> Procédures simplifiées </b> <br>
                                    Pour l\'enregistrement et le départ, la plupart des opérations administratives peuvent être effectuées en ligne, limitant autant que possible les contacts physiques.
                                    <br>
                                    <b> Réservations plus flexibles </b> <br>
                                    Plus grande liberté dans le choix des dates de séjour et dans la possibilité de déplacer votre réservation sans pénalité
                                    <br>
                                    <b> Plage avec plus d\'espace disponible </b> <br>
                                    Une plus grande distance entre les parapluies, pour offrir un plus grand confort et garantir une plus grande distance
                                    <br>
                                    <b> Parking gratuit dans le garage </b> <br>
                                    Un plus dédié à ceux qui préfèrent voyager en voiture, en évitant les transports en commun';


        $TitoloDEU      = 'Wir kümmern uns um Sie! <br> Entdecken Sie die neuen Arrangements für Ihren Urlaub!';
        $TestoDEU       = 'Hier ist die Antwort für '.$v['nome'].' um noch sicherere und friedlichere Aufenthalte zu gewährleisten!
                                <br><br>                        
                                Wir haben viele Aspekte unserer Gastfreundschaft überprüft, damit wir sicherstellen können, dass jeder Moment eines Aufenthalts im '.$v['nome'].' kann eine angenehme und sichere Erfahrung sein. <br> <br> Die Sicherheit und Gelassenheit unserer Gäste steht an erster Stelle.
                                <br><br>
                                Einige unserer Maßnahmen betreffen zum Beispiel:
                                <br><br>
                                <b> Mitarbeiterschulung </b> <br>
                                Spezifische Schulung für alle unsere Mitarbeiter, um die Möglichkeit einer Ansteckung zu minimieren
                                <br>
                                <b> Mitarbeiterzertifizierung </b> <br>
                                Regelmäßige Überwachung des Gesundheitszustands unserer Mitarbeiter und ihres Impfstatus
                                <br>
                                <b> Frühstück </b> <br>
                                Ein Service, der so organisiert ist, dass ein angemessener Abstand gewährleistet und eine Kontamination vermieden wird
                                <br>
                                <b> Restaurant </b> <br>
                                Ein präziser und aufmerksamer Service, bei dem jedes Gericht am Tisch serviert wird und die höchste Qualität unserer Gourmetgerichte gewährleistet ist.
                                <br>
                                <b> Raumreinigung </b> <br>
                                Zur traditionellen Reinigung wird täglich eine spezielle Desinfektion jeder Oberfläche hinzugefügt, um maximale Garantie zu bieten. Das Waschen und Desinfizieren der Wäsche wird zertifiziert.
                                <br>
                                <b> Desinfektion des Spas und des Pools </b> <br>
                                Die öffentlichen Bereiche, die der Entspannung und dem Wohlbefinden gewidmet sind, werden so verwaltet, dass eine größere Distanzierung und kontinuierliche Desinfektion möglich sind
                                <br>
                                <b> Neue Dienste und Möglichkeiten </b> <br>
                                Vom Abendessen mit Meerblick auf dem Balkon Ihres Zimmers bis zum Zimmerservice zum Frühstück: Alle Zimmerservices werden nach Maß und ohne Zuschlag angeboten
                                <br>
                                <b> Vereinfachte Verfahren </b> <br>
                                Beim Ein- und Auschecken können die meisten Verwaltungsvorgänge online ausgeführt werden, wodurch der physische Kontakt so weit wie möglich eingeschränkt wird
                                <br>
                                <b> Flexiblere Reservierungen </b> <br>
                                Mehr Freiheit bei der Auswahl der Aufenthaltsdaten und bei der Möglichkeit, Ihre Buchung ohne Vertragsstrafe zu verschieben
                                <br>
                                <b> Strand mit mehr Platz </b> <br>
                                Größerer Abstand zwischen den Regenschirmen, um mehr Komfort zu bieten und einen größeren Abstand zu gewährleisten
                                <br>
                                <b> Kostenloser Garagenstellplatz </b> <br>
                                Ein Plus für diejenigen, die lieber mit dem Auto anreisen und öffentliche Verkehrsmittel meiden';

 
                $select = "SELECT Id FROM hospitality_boxinfo_checkin WHERE idsito = ".$_REQUEST['idsito']." ORDER BY Id DESC";
                $r      = $db_quoto->query($select);  
                $rec    = $r[0];
                $Id_infohotel = $rec['Id'];
                
                $lingue     = array('it','en','fr','de');
 
                foreach($lingue as $key => $value) {

                        switch($value){
                            case"it":
                                $Tit    = $Titolo;
                                $Text   = $Testo;
                            break;
                            case"en":
                                $Tit    = $TitoloENG;
                                $Text   = $TestoENG;
                            break;
                            case"fr":
                                $Tit    = $TitoloFRA;
                                $Text   = $TestoFRA;
                            break;
                            case"de":
                                $Tit    = $TitoloDEU;
                                $Text   = $TestoDEU;
                            break;
                        }


                        $ins = "INSERT INTO hospitality_boxinfo_checkin_lang(
                                            idsito,
                                            Id_infohotel,
                                            Lingua,
                                            Titolo,      
                                            Descrizione
                                            ) 
                                            VALUES(
                                            '".$v['idsito']."',
                                            '".$Id_infohotel."',
                                            '".$value."',
                                            '".addslashes($Tit)."',
                                            '".addslashes($Text)."'
                                            )";
                        $db_quoto->query($ins);  
     
                }


        
    }
?>
