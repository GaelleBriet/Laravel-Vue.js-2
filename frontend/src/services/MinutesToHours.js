export function getMinutesToHours(minutes) {
  let hours = Math.floor(minutes / 60);
  let minutesLeft = minutes % 60;

  if (minutesLeft === 0) {
    return hours + "h";
  } else {
    return hours + "h " + minutesLeft + "min";
  }
}
