import {Swiper} from 'swiper';
import {Navigation, Thumbs} from "swiper/modules";
import { Pagination } from "swiper/modules";
import { Autoplay } from "swiper/modules";
Swiper.use([Navigation, Pagination, Autoplay, Thumbs]);
window.Swiper = Swiper;
