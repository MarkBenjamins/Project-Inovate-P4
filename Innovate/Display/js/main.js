/**
 * main functies
 * hier worden alle functies aangeroepen
 * 
 * @manual
 * Stap 1. 
 * plaats je import in het volgende formaat:
 * import { functieNaam } from 'fileLocatie';
 * 
 * Stap 2.
 * roep daarna de functie aan
 * 
 * Stap 3.
 * aan het eind van de file met de functie zet je een export in dit formaat:
 * export { functienaam };
 */

// Funtie om de tijd op te halen.
import { getTime } from './getTime.js';
getTime();

// Functie om de datum op te halen.
import { getCurrentDate } from './getDate.js';
getCurrentDate();

// Functie om de gegevens uit de JSON file te lezen.
import { getDetails } from './getDetails.js';
getDetails();

// Functie om de aanwezigheid te wijzigen in de database.
import { sendData } from './setStatus.js';
sendData();