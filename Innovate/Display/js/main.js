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

 // Importeer de code om de tijd weer te geven
import { getTime } from './getTime.js';
getTime();

// Importeer de code om de datum weer te gebven.
import { getCurrentDate } from './getDate.js';
getCurrentDate();

// import de code om de docenten op te halen
import { getDetails } from './getDetails.js';
getDetails();