const CHART_COLORS = {
  red: 'rgb(255, 99, 132)',
  orange: 'rgb(255, 159, 64)',
  yellow: 'rgb(255, 205, 86)',
  green: 'rgb(75, 192, 192)',
  blue: 'rgb(54, 162, 235)',
  purple: 'rgb(153, 102, 255)',
  grey: 'rgb(201, 203, 207)'
};

function __transrgb__ (alpha) {
  rgbas = {
    red: `rgba(255, 99, 132, ${alpha})`,
    orange: `rgba(255, 159, 64, ${alpha})`,
    yellow: `rgba(255, 205, 86, ${alpha})`,
    green: `rgba(75, 192, 192, ${alpha})`,
    blue: `rgba(54, 162, 235, ${alpha})`,
    purple: `rgba(153, 102, 255, ${alpha})`,
    grey: `rgba(201, 203, 207, ${alpha})`
  }
  return rgbas
};
const NAMED_COLORS = [
  CHART_COLORS.red,
  CHART_COLORS.orange,
  CHART_COLORS.yellow,
  CHART_COLORS.green,
  CHART_COLORS.blue,
  CHART_COLORS.purple,
  CHART_COLORS.grey,
];

function transparent_color(color_name, alpha){
  return __transrgb__(alpha)[color_name];
}
// This JavaScript function always returns a random number between min and max (both included):
function random_int(min, max) {
  return Math.floor(Math.random() * (max - min + 1) ) + min;
}