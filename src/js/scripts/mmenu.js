import Mmenu from 'mmenu-js';

const initMmenu = () => {
  new Mmenu('#mmenu', {
    extensions: ['pagedim-black', 'position-front'],
    navbars: [
      {
        position: 'bottom',
        content: ["<a href='#/'></a>", "<a href='#/'></a>"],
      },
    ],
  });
};

export default initMmenu;
