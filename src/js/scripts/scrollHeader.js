const scrollHeader = () => {
  document.querySelector('#header').classList.remove('scroll');
  window.addEventListener('scroll', function() {
    if ($(this).scrollTop() > 200)
      return document.querySelector('#header').classList.add('scroll');

    document.querySelector('#header').classList.remove('scroll');
  });
};

export default scrollHeader;
