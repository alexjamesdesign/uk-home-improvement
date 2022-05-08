import EmblaCarousel from "embla-carousel";

const setupEmblaCarousel = (emblaNode, options) => {
    const wrap = document.querySelector(".embla");
    const viewPort = wrap.querySelector(".embla__viewport");
    const embla = EmblaCarousel(viewPort, {
      dragFree: true,
      containScroll: "trimSnaps",
    });
};

const options = { loop: true };
const emblaNodes = [].slice.call(document.querySelectorAll(".embla"));
const emblaCarousels = emblaNodes.map(emblaNode =>
  setupEmblaCarousel(emblaNode, options)
);