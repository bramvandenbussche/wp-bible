<?php
/*
Plugin Name: WP-Bible
Plugin URI: http://wordpress.org/extend/plugins/wp-bible/
Description: Plugin finds Bible references in your posts and changes them for the actual text from the Bible. You can choose any of 38 different translations in 14 languages that are available at <a href="http://www.biblija.net">BIBLIJA.net</a>.
Version: 1.8
Author: Matej Nastran
Author URI: http://matej.nastran.net/
*/

/*  Copyright 2008  Matej Nastran (email : matej@nastran.net)

    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License as published by
    the Free Software Foundation; either version 2 of the License, or
    (at your option) any later version.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program; if not, write to the Free Software
    Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/

$biblija_version = "1.8";
$biblija_head_displayed = false;


if (!defined('ABSPATH'))
	die("Hello world!");


load_plugin_textdomain("wp_bible", 'wp-content/plugins/wp-bible');
$biblija_warn = "";

require_once( ABSPATH . "wp-includes/class-snoopy.php");
   
function bible_str_replace_once($search, $replace, $subject)
{
    if(($pos = strpos($subject, $search)) !== false)
    {
        $ret = substr($subject, 0, $pos).$replace.substr($subject, $pos + strlen($search));
    }
    else
    {
        $ret = $subject;
    }
   
    return($ret);
}   


/* First, we need to make an instance of the class */
$biblija_snoopy = new Snoopy();
$biblija_snoopy->agent = "WP-Bible plugin/".$biblija_version." (+http://wordpress.org/extend/plugins/wp-bible/)";

$bible_ver[1] = "Slovenian: Slovenski standardni prevod (1997) - SSP";
$bible_ver[4] = "Slovenian: Jubilejni prevod NZ (1984) - JUB";
$bible_ver[5] = "Slovenian: Ekumenski prevod (1974) - EKU";
$bible_ver[6] = "Slovenian: Chráskov prevod (1914) - CHR";
$bible_ver[7] = "English: American Standard Version (1901) - ASV";
$bible_ver[8] = "English: King James Version (1611) - KJV";
$bible_ver[9] = "Latin: Biblia Sacra Vulgata (IV./V. sec.) - VUL";
$bible_ver[10] = "French: Louis Segond (1910) - SEG";
$bible_ver[11] = "Russian: Synodal Version (1876) - RUS";
$bible_ver[12] = "Slovenian: Dalmatinova Biblija (1584) - DAL";
$bible_ver[13] = "German: Luther (1545) - L45";
$bible_ver[14] = "Slovenian: SSP - osnovna izdaja (2001) - SSP3";
$bible_ver[15] = "English: World English Bible - WEB";
$bible_ver[16] = "Spanish: Biblia Dios Habla Hoy - DHHE";
$bible_ver[17] = "Dutch: NBG-vertaling 1951 - NBG51";
$bible_ver[18] = "Dutch: Groot Nieuws Bijbel (1996) - GNB96";
$bible_ver[19] = "Dutch: De Nieuwe Bijbelvertaling (2004/2007) - NBV";
$bible_ver[20] = "Spanish: Biblia Reina Valera - revisión de 1995 - RVR95E";
$bible_ver[21] = "Spanish: Biblia Reina Valera - revisión de 1995 - RVR95";
$bible_ver[23] = "Spanish: Biblia Dios Habla Hoy - DHH";
$bible_ver[25] = "Catalan: Bíblia Catalana Interconfessional) - BCI";
$bible_ver[26] = "English: Good News Bible (UK) - GNB-UK";
$bible_ver[27] = "English: Contemporary English Version (UK) - CEV-UK";
$bible_ver[28] = "Slovenian: Wolfova Biblija (1856-59) - WLF";
$bible_ver[29] = "Slovenian: Japljeva Biblija (1784-1802) - JAP";
$bible_ver[30] = "Greek: Westcott-Hort Greek New Testament (1885) - GNTWH";
$bible_ver[31] = "Romanian: Biblia Cornilescu (1921; 2002) - RCB";
$bible_ver[32] = "Arabic: Today's Arabic Version CL NT - TAV";
$bible_ver[33] = "English: Contemporary English Version (1999) - CEV";
$bible_ver[34] = "English: Good News Bible (1992) - GNB";
$bible_ver[35] = "Bask: Elizen Arteko Biblia (2004) - EAB";
$bible_ver[36] = "Dutch: Willibrordvertaling (1995) - WV95";
$bible_ver[37] = "Dutch: Statenvertaling editie 1977) - SV77";
$bible_ver[38] = "Dutch: Statenvertaling Jongbloed-editie - SV";
$bible_ver[39] = "Latin: Vulgata Clementina (1592) - VLC";
$bible_ver[40] = "Dutch: De Nieuwe Bijbelvertaling (2004/2007) - PDA - NBV-PDA";
$bible_ver[41] = "Croatian: Hrvatska Biblija (KS) - HKS";
$bible_ver[43] = "Dutch: De Nieuwe Bijbelvertaling Tanacheditie (2006) - NBV-T";
$bible_ver[44] = "Statenvertaling 1637, SV1637";
$bible_ver[47] = "Deux-Aesbijbel (1562), DA1562";
$bible_ver[48] = "Herziene Statenvertaling (2010), HSV";
$bible_ver[49] = "Friese Bijbel 1943 (Wumkes-Folkertsma), FB43";
$bible_ver[50] = "Nije Fryske Bibeloersetting (1978), NFB";
$bible_ver[51] = "Biebel (in t Grunnegers) (2008), GRB";
$bible_ver[52] = "Biestkensbijbel (1560), BIE1560";
$bible_ver[53] = "Liesveltbijbel (1542), LIE1542";
$bible_ver[56] = "Lutherse vertaling (1648), LUT1648";
$bible_ver[57] = "Leuvense bijbel (1548), LEU1548";
$bible_ver[58] = "Vorstermanbijbel (1528/1531), VOR1531";
$bible_ver[59] = "Delftse bijbel (1477), DEL1477";
$bible_ver[61] = "Lithuanian, LIT";


$biblija_knjige[] = array ("1 Mz", "1 Mojz", "Gen", "Gn", "Ge", "Post", "Has", "Geneza", "1 Mojzes", "Genesis", "1 Mose", "Génesis", "Beresjiet");
$biblija_knjige[] = array ("2 Mz", "2 Mojz", "Exo", "Ex", "Exod", "Izl", "Ir", "Eksodus", "2 Mojzes", "Exodus", "2 Mose", "Éxodo", "Sjemot");
$biblija_knjige[] = array ("3 Mz", "3 Mojz", "Lev", "Lév", "Lv", "Lb", "Leu", "Levitik", "3 Mojzes", "Leviticus", "3 Mose", "Levítico", "Wajikra");
$biblija_knjige[] = array ("4 Mz", "4 Mojz", "Num", "Nm", "Nu", "Nb", "Nomb", "Br", "Zen", "Numeri", "4 Mojzes", "Numbers", "4 Mose", "Números", "Bemidbar");
$biblija_knjige[] = array ("5 Mz", "5 Mojz", "Deu", "Dt", "Deut", "Pnz", "Devteronomij", "5 Mojzes", "Deuteronomium", "Deuteronomy", "5 Mose", "Deuteronomio", "Devariem");
$biblija_knjige[] = array ("Joz", "Jos", "Josh", "Ios", "Jš", "Jozue", "Joshua", "Jozua", "Josua", "Josué", "Jehoesjoea");
$biblija_knjige[] = array ("Sod", "Sodn", "Jdg", "Judg", "Jg", "Jug", "Jdc", "Jue", "Jt", "Idc", "Re", "Ri", "Richt", "Epa", "Sodniki", "Judges", "Rechters", "Richteren", "Richter", "Jueces", "Juges", "Sjoftiem");
$biblija_knjige[] = array ("Rut", "Ru", "Rth", "Rt", "Ruth", "Ruta", "Roet");
$biblija_knjige[] = array ("1 Sam", "1 Sa", "1 S", "1 Sm", "1 Rg", "1 Regn", "1 Samuel", "1 Samuël", "1 Sjmoeëel");
$biblija_knjige[] = array ("2 Sam", "2 Sa", "2 S", "2 Sm", "2 Rg", "2 Regn", "2 Samuel", "2 Samuël", "2 Sjmoeëel");
$biblija_knjige[] = array ("1 Kr", "1 Kra", "1 Kralj", "1 Ki", "1 Kgs", "1 R", "1 Re", "3 Rg", "3 Regn", "1 Kon", "1 Kön", "1 Erg", "1 Rois", "1 Kings", "1 Kralji", "1 Koningen", "1 Königen", "1 Reyes", "1 Melachiem");
$biblija_knjige[] = array ("2 Kr", "2 Kra", "2 Kralj", "2 Ki", "2 Kgs", "2 R", "2 Re", "4 Rg", "4 Regn", "2 Kon", "2 Kön", "2 Erg", "2 Rois", "2 Kings", "2 Kralji", "2 Koningen", "2 Königen", "2 Reyes", "2 Melachiem");
$biblija_knjige[] = array ("1 Krn", "1 Kron", "1 Let", "1 Ljet", "1 Ch", "1 Cr", "1 Cro", "1 Kro", "1 Chron", "1 Chr", "1 kroniška", "1 Letopisi", "1 Chronicles", "1 Kronieken", "1 Chronik", "1 Crónicas", "1 Devariem");
$biblija_knjige[] = array ("2 Krn", "2 Kron", "2 Let", "2 Ljet", "2 Ch", "2 Cr", "2 Cro", "2 Kro", "2 Chron", "2 Chr", "2 kroniška", "2 Letopisi", "2 Chronicles", "2 Kronieken", "2 Chronik", "2 Crónicas", "2 Devariem");
$biblija_knjige[] = array ("Ezr", "Ezdr", "Ezra", "Esra", "Esr", "Esd", "1 Ezr", "1 Esr", "Ezdra", "Esdras");
$biblija_knjige[] = array ("Neh", "Néh", "Ne", "Né", "2 Ezr", "2 Esr", "Nehemija", "Nehemiah", "Nehemia", "Nehemías", "Nechemja");
$biblija_knjige[] = array ("Est", "Ester", "Esth", "Esther", "Estera");
$biblija_knjige[] = array ("Job", "Hi", "Jb", "Iob", "Hiob", "Ijob", "Iov");
$biblija_knjige[] = array ("Ps", "Psa", "PsG", "Sal", "Sl", "Psalm", "Psalmi", "Psalms", "Psalmen", "Salmos", "Tehiliem");
$biblija_knjige[] = array ("Prg", "Preg", "Pro", "Prov", "Pr", "Prv", "Prou", "Spr", "Izr", "EsZ", "Pregovori", "Proverbs", "Spreuken", "Sprüche", "Sprichwörter", "Proverbios", "Misjlee");
$biblija_knjige[] = array ("Prd", "Prid", "Prop", "Ec", "Ecc", "Eccl", "Ecl", "Qo", "Qoh", "Coh", "Koh", "Pred", "Pridigar", "Ecclesiastes", "Prediker", "Prediger", "Qoheleth", "Qohéleth", "Eclesiastés", "Kohelet");
$biblija_knjige[] = array ("Vp", "Sng", "Song", "Sgs", "SS", "Cant", "Cnt", "Ct", "Kt", "Hoogl", "Hl", "Hld", "Pj", "VisokaPesem", "VisokaP", "Canticles", "Hooglied", "Hoheslied", "Cantares", "Sjier Hasjiriem");
$biblija_knjige[] = array ("Iz", "Izai", "Izaija", "Isa", "Is", "Jes", "Js", "Es", "És", "Isaiah", "Jesaja", "Isaías", "Jesjaja");
$biblija_knjige[] = array ("Jer", "Jér", "Jr", "Ier", "Jeremija", "Jeremiah", "Jeremia", "Jeremías", "Jirmeja");
$biblija_knjige[] = array ("Žal", "Lam", "La", "Lm", "Thr", "Klaagl", "Kl", "Klgl", "Klgld", "Tuž", "Nk", "Žalostinke", "Lamentations", "Klaagliederen", "Klagelieder", "Lamentaciones", "Echa");
$biblija_knjige[] = array ("Ezk", "Ez", "Eze", "Ezec", "Ezek", "Ézék", "Hes", "Ezekiel", "Ezekijel", "Ezechiël", "Ezechiel", "Hesekiel", "Ézékiel", "Ezequiel", "Jechezkeel");
$biblija_knjige[] = array ("Dan", "Da", "Dn", "Daniel", "Danijel", "Daniël", "Danieel");
$biblija_knjige[] = array ("Oz", "Ozea", "Hos", "Ho", "Os", "Hoš", "Ozej", "Hosea", "Osee", "Osée", "Oseas", "Hosjea");
$biblija_knjige[] = array ("Jl", "Jol", "Joel", "Ioel", "Joël", "Joëel");
$biblija_knjige[] = array ("Am", "Amo", "Amos", "Amós");
$biblija_knjige[] = array ("Abd", "Ab", "Oba", "Obd", "Obad", "Ob", "Abdija", "Obadija", "Obadiah", "Obadja", "Abdías", "Ovadja");
$biblija_knjige[] = array ("Jon", "Jnh", "Ion", "Jona", "Jonah", "Jonás");
$biblija_knjige[] = array ("Mih", "Mic", "Mi", "Mch", "Mich", "Miq", "Mihej", "Miha", "Micah", "Micha", "Miqueas");
$biblija_knjige[] = array ("Nah", "Nam", "Na", "Nahum", "Nahúm", "Nachoem");
$biblija_knjige[] = array ("Hab", "Ha", "Habakuk", "Habakkuk", "Habacuc", "Chavakoek");
$biblija_knjige[] = array ("Sof", "Zep", "Zeph", "Zef", "Sef", "So", "Soph", "Sofonija", "Zefanija", "Zephaniah", "Sefanja", "Zephanja", "Zefanja", "Sofonías", "Tsefanja");
$biblija_knjige[] = array ("Ag", "Hag", "Hagg", "Hgg", "Hg", "Agg", "Agej", "Hagaj", "Haggai", "Hageo", "Chagai");
$biblija_knjige[] = array ("Zah", "Zec", "Zech", "Zch", "Za", "Zac", "Zach", "Sach", "Zaharija", "Zechariah", "Zacharia", "Sacharja", "Zacarías", "Zecharja");
$biblija_knjige[] = array ("Mal", "Ml", "Malahija", "Malachi", "Maleachi", "Malaquías");
$biblija_knjige[] = array ("Mt", "Mat", "Matt", "Matej", "Matevž", "Matthew", "Matteüs", "Matteus", "Matthäus", "Mateo");
$biblija_knjige[] = array ("Mr", "Mar", "Mrk", "Mk", "Mc", "Marko", "Mark", "Marcus", "Markus", "Marc", "Marcos");
$biblija_knjige[] = array ("Lk", "Luk", "Lc", "Luc", "Lu", "Luka", "Lukež", "Luke", "Lucas", "Lukas", "Lucas");
$biblija_knjige[] = array ("Jn", "Jan", "Jhn", "Joh", "Jo", "Io", "Iv", "Janez", "John", "Johannes", "Jean", "Juan");
$biblija_knjige[] = array ("Apd", "Dej", "DejAp", "Act", "Ac", "Hand", "Hnd", "Apg", "Dj", "Hch", "Eg", "Acts", "Dela", "Dejanja", "Handelingen", "Apostelgeschichte", "Hechos");
$biblija_knjige[] = array ("Rim", "Rimlj", "Rom", "Röm", "Ro", "Rm", "Erm", "Rimljanom", "Romans", "Romeinen", "Römer", "Romanos");
$biblija_knjige[] = array ("1 Kor", "1 Cor", "1 Co", "1 Ko", "1 K", "1 Korinčanom", "1 Corinthians", "1 Korintiërs", "1 Korintiers", "1 Korinthe", "1 Korinther", "1 Corintios");
$biblija_knjige[] = array ("2 Kor", "2 Cor", "2 Co", "2 Ko", "2 K", "2 Korinčanom", "2 Corinthians", "2 Korintiërs", "2 Korintiers", "2 Korinthe", "2 Korinther", "2 Corintios");
$biblija_knjige[] = array ("Gal", "Ga", "Gl", "Galat", "Galačanom", "Galatians", "Galaten", "Galater", "Gálatas");
$biblija_knjige[] = array ("Ef", "Efež", "Éfez", "Efez", "Eph", "Éph", "Ep", "Efežanom", "Ephesians", "Efeziërs", "Efeziers", "Efeze", "Epheser", "Efesios");
$biblija_knjige[] = array ("Flp", "Filip", "Filipp", "Fil", "Fl", "Php", "Ph", "Phil", "Phili", "Filipljanom", "Philippians", "Filippenzen", "Philipper", "Filipenses");
$biblija_knjige[] = array ("Kol", "Col", "Kološanom", "Colossians", "Kolossenzen", "Kolosser", "Colosenses");
$biblija_knjige[] = array ("1 Tes", "1 Sol", "1 Th", "1 Ts", "1 Te", "1 Tess", "1 Thes", "1 Thess", "1 Tesaloničanom", "1 Thessalonians", "1 Tessalonicenzen", "1 Thessalonicher", "1 Tesalonicenses");
$biblija_knjige[] = array ("2 Tes", "2 Sol", "2 Th", "2 Ts", "2 Te", "2 Tess", "2 Thes", "2 Thess", "2 Tesaloničanom", "2 Thessalonians", "2 Tessalonicenzen", "2 Thessalonicher", "2 Tesalonicenses");
$biblija_knjige[] = array ("1 Tim", "1 Ti", "1 Tm", "1 T", "1 Timoteju", "1 Timothy", "1 Timoteüs", "1 Timoteus", "1 Timotheus", "1 Timoteo");
$biblija_knjige[] = array ("2 Tim", "2 Ti", "2 Tm", "2 T", "2 Timoteju", "2 Timothy", "2 Timoteüs", "2 Timoteus", "2 Timotheus", "2 Timoteo");
$biblija_knjige[] = array ("Tit", "Tt", "Titus", "Titu", "Tite", "Tito");
$biblija_knjige[] = array ("Flm", "Filem", "Film", "Phm", "Phlm", "Phile", "Philem", "Filemonu", "Philemon", "Filemon", "Filemón");
$biblija_knjige[] = array ("Heb", "Hebr", "Hébr", "Hbr", "Hb", "He", "Hé", "Hebrejcem", "Hebrews", "Hebreeërs", "Hebreeers", "Hebreeën", "Hebreeen", "Hebräer", "Hebreos");
$biblija_knjige[] = array ("Jak", "Jas", "Jam", "Jm", "Ja", "Jc", "Jac", "Jacq", "Iac", "Stg", "St", "Jakob", "James", "Jakobus", "Santiago");
$biblija_knjige[] = array ("1 Pt", "1 Pet", "1 Petr", "1 Pe", "1 Pi", "1 P", "1 Peter", "1 Petrus", "1 Pedro");
$biblija_knjige[] = array ("2 Pt", "2 Pet", "2 Petr", "2 Pe", "2 Pi", "2 P", "2 Peter", "2 Petrus", "2 Pedro");
$biblija_knjige[] = array ("1 Jn", "1 Jan", "1 Joh", "1 Jo", "1 J", "1 Io", "1 Iv", "1 John", "1 Janez", "1 Johannes", "1 Jean", "1 Juan");
$biblija_knjige[] = array ("2 Jn", "2 Jan", "2 Joh", "2 Jo", "2 J", "2 Io", "2 Iv", "2 John", "2 Janez", "2 Johannes", "2 Jean", "2 Juan");
$biblija_knjige[] = array ("3 Jn", "3 Jan", "3 Joh", "3 Jo", "3 J", "3 Io", "3 Iv", "3 John", "3 Janez", "3 Johannes", "3 Jean", "3 Juan");
$biblija_knjige[] = array ("Jud", "Juda", "Jude", "Jd", "Ju", "Iud", "Judas");
$biblija_knjige[] = array ("Raz", "Rev", "Ap", "Apc", "Apoc", "Apok", "Apk", "Op", "Openb", "Offb", "Otk", "Razodetje", "Apokalipsa", "Revelation", "Openbaring", "Apokalyps", "Offenbarung", "Apocalipsis");
$biblija_knjige[] = array ("EstG", "EsG", "EstGr", "EsthGr", "EstGrec", "EstD", "EstDC", "GkEst", "AddEsth", "StEst", "Estera(gr)", "Estera(grška)", "Esther(gr)", "Esther(Greek)", "Ester(griechisch)", "Ester(Griego)");
$biblija_knjige[] = array ("Jdt", "Jdth", "Idt", "Judita", "Judith", "Judit");
$biblija_knjige[] = array ("Tob", "Tb", "Tobit", "Tobija");
$biblija_knjige[] = array ("1 Mkb", "1 Mak", "1 Makk", "1 Mc", "1 Mac", "1 Macc", "1 Mcc", "1 Ma", "1 M", "1 Makabejci", "1 Maccabees", "1 Makkabeeën", "1 Makkabeeen", "1 Makkabeeërs", "1 Makkabeeers", "1 Makkabäer", "1 Macabeos");
$biblija_knjige[] = array ("2 Mkb", "2 Mak", "2 Makk", "2 Mc", "2 Mac", "2 Macc", "2 Mcc", "2 Ma", "2 M", "2 Makabejci", "2 Maccabees", "2 Makkabeeën", "2 Makkabeeen", "2 Makkabeeërs", "2 Makkabeeers", "2 Makkabäer", "2 Macabeos");
$biblija_knjige[] = array ("3 Mkb", "3 Mak", "3 Makk", "3 Mc", "3 Mac", "3 Macc", "3 Mcc", "3 Ma", "3 M", "3 Makabejci", "3 Maccabees", "3 Makkabeeën", "3 Makkabeeen", "3 Makkabeeërs", "3 Makkabeeers", "3 Makkabäer", "3 Macabeos");
$biblija_knjige[] = array ("4 Mkb", "4 Mak", "4 Makk", "4 Mc", "4 Mac", "4 Macc", "4 Mcc", "4 Ma", "4 M", "4 Makabejci", "4 Maccabees", "4 Makkabeeën", "4 Makkabeeen", "4 Makkabeeërs", "4 Makkabeeers", "4 Makkabäer", "4 Macabeos");
$biblija_knjige[] = array ("Mdr", "Modr", "Wis", "Wisd", "Weish", "Wijsh", "Sg", "Sag", "Sap", "Sb", "Sab", "Sv", "Mudr", "Jkd", "Modrost", "Wisdom", "Wijsheid", "Weisheit", "Sabiduría");
$biblija_knjige[] = array ("Sir", "Si", "Sirah", "Sirach", "Eclo", "Ecclesiasticus", "Ecclesiastique", "Ecclésiastique", "Eclesiástico");
$biblija_knjige[] = array ("Bar", "Ba", "Baruh", "Baruch", "Baruc");
$biblija_knjige[] = array ("JerP", "LJe", "LJer", "LtJr", "LetJer", "LettreJer", "EpJer", "EpJr", "EpistJer", "BrJer", "CtJ", "JrGt", "JeremijevoP", "JeremijevoPismo", "BriefJeremias", "BrfJer");
$biblija_knjige[] = array ("DanD", "AddDan", "DanAdd", "StDan", "DanZ", "DnGrec", "DanGrec", "DnDC", "DnGr", "PrAzar", "Az", "S3Y", "SofThr", "SongThr", "Daniel(dodatki)", "Daniel(Additions)", "Daniël(Grieks)", "ZusätzezuDaniel", "ToevDan", "DanGr");
$biblija_knjige[] = array ("Suz", "Sus", "Suzana", "Susanna", "Susana");
$biblija_knjige[] = array ("Bel", "BelDr", "Zmaj", "Dragon");
$biblija_knjige[] = array ("Man", "PrMan", "OrMan", "GebMan", "Manase", "Manasse", "Manasses", "PrManasses");
$biblija_knjige[] = array ("1 Esd", "3 Esr", "3 Ezr", "3 Ezra", "1 Esdras", "1 Ezdra", "3 Esdras");
$biblija_knjige[] = array ("2 Esd", "4 Esr", "4 Ezr", "4 Ezra", "2 Esdras", "2 Ezdra", "4 Esdras");
$biblija_knjige[] = array ("Ps151", "Sal151", "Sl151", "Psalm151", "Salmo151", "PsCLI");
$biblija_knjige[] = array ("Lao", "Laod", "Laodikejcem", "Laodiceans");
$biblija_knjige[] = array ("PsH", "PsHeb", "SIH", "PsalmH", "PsalmiH");

$i = 0;
foreach ($biblija_knjige as $knjige)
        foreach ($knjige as $knjiga)
                $moje_knjige[$i++] = $knjiga;

function bible_my_cmp($a, $b)
{
   if (strlen($a) == strlen($b)) {
       return 0;
   }
   return (strlen($a) > strlen($b)) ? -1 : 1;
}


function bible_version_cmp($a, $b)
{
   return strcmp($a, $b);
}



usort($moje_knjige, "bible_my_cmp");
uasort($bible_ver, "bible_version_cmp");

$wp_bible_default_width = get_option('wp_bible_default_width');
if (((int)$wp_bible_default_width) == 0){
   $wp_bible_default_width = 300;
   update_option('wp_bible_default_width', $wp_bible_default_width);
}

$wp_bible_slim = get_option('wp_bible_slim');
if ($wp_bible_slim == ''){
   $wp_bible_slim = 0;
   update_option('wp_bible_slim', $wp_bible_slim);
}

$wp_bible_inline = get_option('wp_bible_inline');
if ($wp_bible_inline == ''){
   $wp_bible_inline = 0;
   update_option('wp_bible_inline', $wp_bible_inline);
}

$wp_bible_new_window = get_option('wp_bible_new_window');
if ($wp_bible_new_window == ''){
   $wp_bible_new_window = 0;
   update_option('wp_bible_new_window', $wp_bible_new_window);
}



$wp_bible_default_version = get_option('wp_bible_default_version');
if (((int)$wp_bible_default_version == 0) || (!strlen($bible_ver[$wp_bible_default_version]))){
   $wp_bible_default_version = 15;
   update_option('wp_bible_default_version', $wp_bible_default_version);
}


$biblija_url1 = "http://www.biblija.net/biblija.cgi?id".($wp_bible_default_version-1)."=1&amp;pos=0&amp;set=5&amp;m=";
$biblija_url2 = "http://www.biblija.net/biblija.cgi?id".($wp_bible_default_version-1)."=1&pos=0&set=5&l=sl&t=3&m=";
$plugin_url = "http://wordpress.org/extend/plugins/wp-bible/";

        


// kaj in kje točno naj se izpiše v admin vmesniku 
function bible_admin_action()
{
   global $biblija_version, $bible_ver, $wpdb, $wp_bible_default_width, $wp_bible_default_version, $wp_bible_slim, $wp_bible_inline, $wp_bible_new_window;

    if (isset($_POST['biblija_update'])) {
    	  if ((int)$_POST['biblija_width'])
    	  	$wp_bible_default_width = (int)$_POST['biblija_width'];
        update_option('wp_bible_default_width', $wp_bible_default_width);
        $wp_bible_slim = (int)$_POST['biblija_slim'];
        update_option('wp_bible_slim', $wp_bible_slim);
        $wp_bible_inline = (int)$_POST['biblija_inline'];
        update_option('wp_bible_inline', $wp_bible_inline);
        $wp_bible_new_window = (int)$_POST['biblija_new_window'];
        update_option('wp_bible_new_window', $wp_bible_new_window);
        if ((int)$_POST['wp_bible_default_version'])
        	 $wp_bible_default_version = (int)$_POST['wp_bible_default_version'];
        update_option('wp_bible_default_version', $wp_bible_default_version);
	   $table_name = $wpdb->prefix . "wp_bible";
	   $wpdb->query ("TRUNCATE TABLE $table_name;");
	   echo '<div class="updated"><p><strong>'.__('Settings updated!', 'wp_bible')."</strong></p></div>";
   }
   ?>
   <div class="wrap">
    <h2><?php _e('WP-Bible default bible version', 'wp_bible'); ?></h2>
        <form method="post">
<br />
           <select name="wp_bible_default_version">
		   <?php
			foreach ($bible_ver as $key => $value) {
                    $bible_selected = $key == $wp_bible_default_version ? "selected" : "";
					echo "<option $bible_selected value='$key'>$value</option>\n";
			}
			?>
			</select>
			<br />
			<br /> 
			<label for="biblija_width"><?php _e("Bible text layer width (in pixels)", "wp_bible"); ?>:&nbsp;
				  <input type="text" size="5" name="biblija_width" value="<?php echo $wp_bible_default_width; ?>" />
			</label>
			<br />
			<br />
			<label for="biblija_slim">
				  <input type="checkbox" <?php echo $wp_bible_slim ? "checked" : ""; ?> name="biblija_slim" value="1" />
				  &nbsp;<?php _e("Only make a link to bible text (and don't display it in overlayed layer)", "wp_bible"); ?>
			</label>
			<br />
			<label for="biblija_new_window">
				  <input type="checkbox" <?php echo $wp_bible_new_window ? "checked" : ""; ?> name="biblija_new_window" value="1" />
				  &nbsp;<?php _e("Open link in new window.", "wp_bible"); ?>
			</label>
			<br />
			<label for="biblija_inline">
				  <input type="checkbox" <?php echo $wp_bible_inline ? "checked" : ""; ?> name="biblija_inline" value="1" />
				  &nbsp;<?php _e("Display bible text inline instead of in a layer above the post.", "wp_bible"); ?>
			</label>
        		<br />
    <p class="submit">
        <input type="submit" name="biblija_update" value="<?php _e('Update Options', 'wp_bible') ?>" />
    </p>
    </form>
   </div>

<?php
   // matej_info ();

}

// inicializiraj admin vmesnik
function bible_add_plugin_to_admin_menu()   
{  
   add_submenu_page('options-general.php', 'WP-Bible', 'WP-Bible', 10, __FILE__, 'bible_admin_action');  
}  

add_action('admin_menu', 'bible_add_plugin_to_admin_menu');
add_filter('the_content', 'bible_the_content');
add_action('wp_head', 'bible_head');


function bible_to_ord ($str){
         $out = "";
         $j = strlen($str);
         for ($i=0; $i<$j;$i++)
             $out .= "&#".ord(substr($str,$i)).";";
         return $out;
}

function bible_head (){
    global $biblija_head_displayed, $biblija_warn;
    global $wp_bible_default_width, $biblija_version, $wp_bible_slim;

    if ($biblija_head_displayed)
       return;
    $biblija_head_displayed = true;
    
    if (!is_feed()){
    	  // v feedu tega ne rabimo!
        echo "\n\n<!-- WP-Bible plugin version $biblija_version -->\n";
    	   if (!$wp_bible_slim ){
    
         ?>	<script type="text/javascript">         
			var biblija_cnt = 200;
			function biblija_showhide (id){
				var obj = document.getElementById(id);
				if (obj.style.display == "inline")
			  		obj.style.display = "none";
				else
			  	obj.style.display = "inline";
			   obj.style.zIndex = biblija_cnt++;
			}
		</script>
		<style type="text/css" id="wp-bible">
			sup { font-size: 70%; vertical-align: top; }
			.biblija_lay { display: none; background:#FFFFFF; border:1px double #000000; color:#000000; font-size:90%; font-style:normal; font-variant:normal; font-weight:normal; letter-spacing:normal; line-height:normal; margin:0px; opacity:0.9; overflow:visible; padding:10px; text-align:left; text-indent:0pt; text-transform:none; vertical-align:baseline; position: absolute; width: <?php echo "$wp_bible_default_width"."px;"; ?> word-spacing:normal; }
			.biblija_lay_inline { background:#FFFFFF; border:1px double #000000; color:#000000; font-size:90%; font-style:normal; font-variant:normal; font-weight:normal; letter-spacing:normal; line-height:normal; margin:0px; opacity:0.9; overflow:visible; padding:10px; text-align:left; text-indent:0pt; text-transform:none; vertical-align:baseline; ?> word-spacing:normal; }
		</style><?php
     }
	    echo "\n<!-- /WP-Bible plugin version $biblija_version -->\n\n";
  	    echo $biblija_warn;
     }

}

$biblija_i = 0;

function bible_the_content($content) {
         global $biblija_i, $moje_knjige, $biblija_url1, $biblija_url2, $wpdb, $biblija_snoopy, $biblija_version, $plugin_url, $wp_bible_default_version, $bible_ver;
         global $wp_bible_slim, $wp_bible_inline, $wp_bible_new_window;
         global $biblija_head_displayed, $biblija_warn;

         if ($biblija_head_displayed == false){
            $biblija_warn = "<!-- \nWARNING: there is no wp_head template call for this page,\n you shouuld FIX it by including ".
		  "wp_head() call in your template...\n-->\n\n";
         	  bible_head ();
         }

         $table_name = $wpdb->prefix . "wp_bible";
         foreach ($moje_knjige as $knjiga){
               $reg = "@$knjiga\.? [0-9]+[:,][ ]{0,1}[0-9]*[ \-0-9;,\.:]*[0-9]+@miu";
               if (preg_match_all($reg, $content, $matches, PREG_PATTERN_ORDER)){
                  foreach ($matches[0] as $curr_match){
                          $match_encoded = bible_to_ord($curr_match);
                          $biblija_i++;
			  $url_match = preg_replace("/($knjiga)\.?(.*)/mi", "$1$2", $curr_match);
                          $url1 = $biblija_url1.urlencode($url_match);
                          $url2 = $biblija_url2.urlencode($url_match);
                          
					 if (!$wp_bible_slim){
					     $bible_res = $wpdb->get_col("SELECT text FROM $table_name WHERE ref LIKE '".$wpdb->escape($url_match)."';");
                              $bible_text = $bible_res[0];
	                          if (!strlen($bible_text)){
	                               $biblija_result = $biblija_snoopy->fetch($url2);
	                               if($biblija_result){
	                                   $bible_text = $biblija_snoopy->results;
	                                   $bible_text = preg_replace ("@<script .*?/script>@im", "", $bible_text);
	                                   $bible_text = preg_replace ("@<a .*?/a>@im", "", $bible_text);
	                                   $bible_text = preg_replace ("@<h3.*?/h3>@im", "", $bible_text);
	                                   $bible_text = preg_replace ("@\(.*?\)@m", "", $bible_text);
	                                   $bible_text = preg_replace ("@<strong.*?/strong>@im", "", $bible_text);
	                                   $bible_text = preg_replace ("@<!--.*?-->@m", "", $bible_text);
	                                   $bible_text = preg_replace ("@<.*?".">@m", "", $bible_text);
	                                   $bible_text = trim($bible_text);
	                                   if (function_exists ('iconv'))
	                                   	  $bible_text = iconv("CP1250", "UTF-8", $bible_text);
	                                   $bible_text = preg_replace ("@([^#0-9])([0-9]+)@m", "\\1<sup>\\2</sup>", $bible_text);
	                                   if (strlen($bible_text))
	                                       $wpdb->query("INSERT INTO $table_name VALUES (0, '".$wpdb->escape($url_match). "','" . $wpdb->escape($bible_text) . "')");
	                               }
	                               else
	                                   $bible_text = "";
	                          }    
	                          if (is_feed())
						    $content = str_replace ($curr_match, "<a class=\"biblija_link\" href=\"$url1\">$match_encoded</a>", $content);
  				           else{
        	                        $div = $wp_bible_inline ? "div" : "span";
       	                        while (strstr ($content, $curr_match)){
                                  		$content = bible_str_replace_once ($curr_match, "<a class=\"biblija_link\" onmouseover=\"biblija_showhide('biblija_l$biblija_i');\">$match_encoded</a><$div class=\"biblija_lay".($wp_bible_inline ? "_inline" : "")."\" onclick=\"biblija_showhide('biblija_l$biblija_i');\" id=\"biblija_l$biblija_i\"><b><a title=\"".$bible_ver[$wp_bible_default_version]."\" href=\"$url1\">$match_encoded<br />".$bible_ver[$wp_bible_default_version]."</a></b><br />$bible_text<br /><br /><span style=\"text-align: right\"><a href=\"$plugin_url\" title=\"WP-Bible plugin version $biblija_version\">WP-Bible plugin</a></span></$div>", $content);
                                  		$biblija_i++;
                                  }
                               }
					 }
					 else {
							if ($wp_bible_new_window)
								$target = "target=\"_blank\"";
							else
								$target = "";
                          	 $content = str_replace ($curr_match, "<a $target class=\"biblija_link\" href=\"$url1\">$match_encoded</a>", $content);
						}
                  }
               }
         }
         $content = str_replace (array ("[biblija]", "[/biblija]"), array("", ""), $content);
         return $content;
         //  dodaj še "\n<br clear=\"all\">"; 
}



function check_table (){
   global $wpdb;
   $table_name = $wpdb->prefix . "wp_bible";
   if($wpdb->get_var("show tables like '$table_name'") != $table_name) {
      
      $sql = "CREATE TABLE " . $table_name . " (
      	  id mediumint(9) NOT NULL AUTO_INCREMENT,
	       ref VARCHAR(255) NOT NULL,
	       text text NOT NULL,
	       UNIQUE KEY id (id)
	       );";

      require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
      dbDelta($sql); 
 }
 }

check_table ();

?>