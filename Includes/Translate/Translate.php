<?php
//put your translations here
//USE English keys! Be professional.

class Translate
{
    //NL,EN
    static $Translations = [

        "inlogPagRememberMe" => ["Onthoud mij", "Remember me"],
        "inlogPagGoodButNoLogin" => ["Je wachtwoord was goed echter werkt het doorverwijzen nog niet!",
            "Your credentials were correct. Only the next page is not responding.!"],
        "inlogPagLoginIncorrect" => ["De combinatie van gebruiker en/of wachtwoord is onjuist.",
            "De combination of user and/or password is incorrect."],
        "inlogPagUserNameLabel" => ["Gebruikersnaam:", "Username:"],
        "inlogPagPasswordLabel" => ["Wachtwoord:", "Password:"],
        "inlogPagForgotPassword" => ["Wachtwoord vergeten", "Forgot password"],
        "inlogRegister" => ["Registreren", "Register"],
        "inlogSubmit" => ["Log in", "Log on"],

        "gebruikerEmailInvalid" => ["Het emailadres is ongeldig.", "Email is invalid."],
        "gebruikerEmailIsrequired" => ["Het emailadres is verplicht.", "Email is required."],
        "gebruikerUsernameIsrequired" => ["De gebruikersnaam is verplicht.", "Username is required."],
        "gebruikerUsernameInvalid" => ["De gebruikernaam is ongeldig. Gebruik geen leestekens of spaties."
            , "The username is invalid. Do not use punctuation marks or spaces"],
        "gebruikerUsernameIsInUse" => ["Gebruikersnaam is al reeds gebruikt. Kies een andere gebruikersnaam.",
            "This username is already taken. Use another usename."],
        "gebruikerPasswordsNotEqual" => ["De wachtwoorden zijn niet gelijk.",
            "The passwords are not equal."],
        "gebruikerRecordNotSaved" => ["Record niet opgeslagen.", "Record not saved"],
        "gebruikerCreateLogin" => ["Aanmaken login gegevens.", "Create a login."],
        "gebruikerUsernameLabel" => ["Gebruikersnaam *", "Username *"],
        "gebruikerEmailLabel" => ["Email *", "Email *"],
        "gebruikerPasswordLabel" => ["Wachtwoord *", "Password *"],
        "gebruikerPasswordLabelCheck" => ["Wachtwoord controle*", "Password check*"],

        "vraag-een" => ["Voor wie is StudentenServices?", "Who can use StudentServices?"],
        "Antwoord-een" => ["StudentenServices is voor Studenten die graag hulp willen krijgen of juist hulp willen aanbieden aan andere studenten.",
            "StudentServices is made for students who could use some help or students who wants to help other studens."],
        "vraag-twee" => ["Ben ik te oud voor StudentenServices?", "Am I too old to use StudentServices?"],
        "Antwoord-twee" => ["Zolang je student bent ben je welkom bij StudentSerivces, voor ons is leeftijd maar een cijfer!",
            "You are welcome as long as you are a student, your age is just a number!"],
        "vraag-drie" => ["Waarom staat mijn school er niet bij?", "Why can't i find my school?"],
        "Antwoord-drie" => ["Voor jou school hebben we nog geen overeenkomst, neem contact op via het contactformulier dan gaan we hier z.s.m. een oplossing voor zoeken.",
            "We haven't contracts with you school, let us know and we wil search for a solution"],
        "vraag-vier" => ["Mag ik hier ook mijn spullen te koop aanbieden?", "Is it allowed to sell my goods?"],
        "Antwoord-vier" => ["Ons doel is om studenten te helpen met hun problemen of vraagstukken. Miscchien kan er iemand je helpen met het maken van je eigen webshop!",
            "Our goal is too help students with their problems, maybe you can find a student who can make a webshop to sell your goods!"],
        "vraag-vijf" => ["Hoe kom ik in contact met StudentSerivces", "How do I get in touch with StudentSerivces?"],
        "Antwoord-vijf" => ["Dit kan via het contactformulier die te vinden is op onze pagina.",
            "This can be done with the contact form that can be found on our page."],
        "vraag-zes" => ["Waarom reageert er niemand op mijn project?", "Why is no one responding to my project?"],
        "Antwoord-zes" => ["Helaas is er nog niemand die zich bekwaam genoeg voelt om jou te helpen. Heb geduld en we zoeken met je mee.",
            "Unfortunately, no one is yet competent enough to help you. Be patient and we will search with you."],
        "vraag-zeven" => ["Mag ik buiten StudentenServices nog meer hulp vragen?",
            "Can I ask for more help outside Student Services?"],
        "Antwoord-zeven" => ["Natuurlijk! Wij proberen een hulpmiddel te zijn en als een ander je al heeft geholpen dan horen we dat graag.",
            "Of course! We try to be an aid and let us know if somebody already helped you."],
        "vraag-acht" => ["Hoe kan ik jullie bedanken?", "How can i thank you?"],
        "Antwoord-acht" => ["Wij zijn niet bang voor complimenten, laat het ons weten via het contactformulier!",
            "Compliments are always welcome! Sent your love with the contact form."],

        "contactformulier" => ["Contactformulier", "Contact form"],
        "contactVoornaam" => ["Voornaam", "Firstname"],
        "contactVoornaamPlaceholder" => ["Vul hier je voornaam in.", "Enter your first name."],
        "contactAchternaam" => ["Achternaam", "Last name."],
        "contactAchternaamPlaceholder" => ["Vul je achternaam in.", "Enter your last name."],
        "contactEmail" => ["E-mail", "Email"],
        "contactEmailPlaceholder" => ["Vul je e-mailadres in.", "Enter your emailaddress."],
        "contactEmail2" => ["E-mailadres controle", "Emailaddress control"],
        "contactEmailPlaceholder2" => ["Vul je e-mailadres nogmaals in.", "Enter your email address again."],
        "contactTelefoon" => ["Telefoonnummer", "Phone number"],
        "contactTelefoonPlaceholder" => ["Vul je telefoonnummer in.", "Enter your phone number."],
        "contactContactVoorkeur" => ["Contactvoorkeur", "Contact preference"],
        "contactOpmerking" => ["Opmerking", "Comment"],
        "contactOpmerkingPlaceholder" => ["Vul hier uw opmerking in.", "Enter your comment."],
        "contactVerstuur" => ["Verstuur", "Submit"],
        "contactTerug" => ["Terug naar contact", "Back to contact"],

        "homeWelkom" => ["Welkom", "Welcome"],
        "homeEmail" => ["Emailadres:", "Emailaddress:"],
        "homeProjecten" => ["Projecten", "Projects"],
        "homeAanbiedend" => ["Mijn aanbiedende projecten", "Help others with their projects"],
        "homeVragend" => ["Mijn vragende projecten", "Others helping me with my projects"],
        "homeReacties" => ["Reacties", "Reactions"],
        "homeReactie1" => ["Reactie op jouw project:", "Reaction on your project:"],
        "homeReactie2" => ["Jouw reactie op project:", "Your reaction on project:"],
        "homeVerzondenDoor" => ["Verzonden door", "Send by"],
        "homeOm" => ["om", "at"],
        "homeFeedback" => ["Feedback", "Feedback"],
        "homeFeedbackDoor" => ["Feedback door", "Feedback by"],
        "homeFeedbackOpProject" => ["Feedback op project:", "Feedback on project:"],
        "homeCijfer" => ["Gegeven cijfer", "Given score"],
        "homeFeedbackVanJou" => ["Jouw feedback op project:", "Your feedback on project:"],
        "homeFeedbackVanAnder" => ["Gegeven feedback door", "Given feedback by "],

        //labels van de homepage controller
        "homegeen project gevonden"=>['geen project gevonden', 'no project found'],
        "homegeen reactie gevonden"=>['geen reactie gevonden', 'no reaction found'],
        "homegeen feedback gevonden"=>['geen feedback gevonden', 'no feedback found'],
        "homeonbekend"=>['onbekend', 'unknown'],
        "homeactief"=>['actief', 'active'],
        "homenon actief"=>['non actief, non active'],
        'homeverwijderd'=>['verwijderd', 'deleted'],

        "ProjectNieuw" => ['Nieuw project', 'New project'],
        "ProjectfilterKlaar" => ['Klaar',"Done"],
        "ProjectfilterBezig" => ['Mee bezig', "Doing"],
        "ProjectCategorie" => ['Categorie',"Category"],
        "ProjectfilterVraag" => ['Gevraagd', "Asked"],
        "ProjectfilterAanbod" => ['Aangeboden', "Offered"],
        "ProjectfilterMijn" => ['Mijn projecten','My projects'],
        "ProjectfilterAnder" => ['Niet mijn projecten','Not my projects'],
        "ProjectNietGevonden" => ['Er zijn geen projecten gevonden aan de hand van de opgegeven criteria.',
            'There are no projects found on the given criterium' ],
        "ProjectGemaaktDoor" => ['Gemaakt door',"Created by"],
        "ProjectVorige" => ['&laquo; Vorige','&laquo; Previous'],
        "ProjectVolgende" => ['Volgende &raquo;','Next &raquo;'],
        "ProjectGemaaktOp" => ['Aanmaakdatum', 'Creation date'],
        "ProjectEdit" => ['Wijzig project', "Edit project"],
        "ProjectKlaar" => ['Project klaar', "Project finished"],
        "ProjectReactieNieuw" => ['Nieuwe reactie',"New reaction"],
        "ProjectReactieGegevenDoor" => ['Gegeven door',"Given by"],
        "ProjectLocatie" => ['Locatie', "Location" ],
        "ProjectTerug" => ['Terug',"Back"],
        "ProjectVoegToe" => ['Toevoegen',"Add"],
        "ProjectNietBekend" => ['Niet Bekend',"Unknown"],

        "menuHome" => ['Home', 'Home'],
        "menuMijnProfiel" => ['Mijn Profiel','My Profile'],
        "menuProjecten" => ['Projecten','Projects'],
        "menuFAQ" => ['FAQ','FAQ'],
        "menuContact" => ['Contact','Contact'],
        "menuUitloggen" => ['Uitloggen','Log out'],

        "profielProfiel" => ['Profiel : ', 'Profile : '],
        "profielVoornaam" => ['Voornaam*','Firstname*'],
        "profielTussen" => ['Tussenvoegsel','Insertion'],
        "profielPrefix" => ['Prefix','Prefix'],
        "profielAchternaam" => ['Achternaam*','Lastname*'],
        "profielStraat" => ['Straat*','Street*'],
        "profielHuisnummer" => ['Huisnummer*','House number*'],
        "profielExtentie" => ['Extentie','Extention'],
        "profielPostcode" => ['Postcode*','Postal Code*'],
        "profielWoonplaats" => ['Woonplaats*','Residence*'],
        "profielGeboortedatum" => ['Geboortedatum','Date of birth'],
        "profielSchool" => ['School','School'],
        "profielOpleiding" => ['Opleiding','Education'],
        "profielStart" => ['Startdatum','Start date'],
        "profielStatus" => ['Status','Status'],
        "profielTelefoonnummer" => ['Telefoonnummer','Phonenumber'],
        "profielFoto" => ['Profielfoto','Profile picture'],
      
        "ProjectenBeschikbaarheidButton" => ['Beschikbaarheid',"Availability"],

        "BeschikbaarheidStartTimeLabel"=> ['Starttijd',"Start time"],
        "BeschikbaarheidEndTimeLabel"=> ['Eindtijd',"End time"],
        "BeschikbaarheidRecordnotSaved"=> ['Record niet opgeslagen.',"Record not saved."],
        "BeschikbaarheidAddAvailabilityFor"=> ["Toevoegen beschikbaarheid voor project : ","Add availability for : "],
        "BeschikbaarheidEditAvailabilityFor"=> ["Wijzigen beschikbaarheid voor project : ","Edit availability for : "],
        "Beschikbaarheid"=> ["Beschikbaarheid","Availability"],
        "BeschikbaarheidBack"=> ["Terug","Back"],
        "BeschikbaarheidNew"=> ["Nieuwe toevoegen","Add new"],
    ];

    public static function GetTranslation(string $key): string{
        if (!isset($_COOKIE["Language"])){
            $_COOKIE["Language"] = "NL";
        }//NL is the default!
        if ($_COOKIE["Language"] == "NL"){
            return self::$Translations[$key][0];
        }
        if ($_COOKIE["Language"] == "EN"){
            return self::$Translations[$key][1];
        }
    }
}

?>

