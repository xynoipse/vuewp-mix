import './utils/objectFitImages';

import scrollHeader from './scripts/scrollHeader';
import initMmenu from './scripts/mmenu';

$(window).on('load', () => {});

document.addEventListener('DOMContentLoaded', () => {
  scrollHeader();
  initMmenu();
});
