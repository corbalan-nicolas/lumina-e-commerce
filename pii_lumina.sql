-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 27-06-2025 a las 08:40:45
-- Versión del servidor: 10.4.32-MariaDB
-- Versión de PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `pii_lumina`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `candles`
--

CREATE TABLE `candles` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(256) NOT NULL,
  `description` text NOT NULL,
  `id_category` int(10) UNSIGNED NOT NULL,
  `main_img` varchar(256) NOT NULL,
  `price` decimal(4,2) NOT NULL,
  `discount` tinyint(4) NOT NULL,
  `css_color` varchar(256) NOT NULL,
  `date_release` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `candles`
--

INSERT INTO `candles` (`id`, `name`, `description`, `id_category`, `main_img`, `price`, `discount`, `css_color`, `date_release`) VALUES
(5, 'Vainilla', 'Dulce, cálida y reconfortante, la vela de vainilla es ideal para tardes lluviosas, momentos de cocina casera o reuniones íntimas. Su fragancia envuelve la habitación como un abrazo suave y familiar, convirtiendo cualquier espacio en un rincón acogedor donde el tiempo parece pasar más lento.', 2, 'vanilla-cover.webp', 12.00, 0, 'var(--col-vanilla)', '2025-06-27 05:36:48'),
(6, 'Eucalipto', 'Perfecta para un lunes a la mañana o cualquier momento en que necesites claridad mental, esta vela de eucalipto refresca el ambiente y renueva la energía del espacio. Su aroma herbal y ligeramente mentolado despeja tanto el aire como las ideas, ideal para concentrarse, estudiar o trabajar desde casa.', 3, 'eucalyptus-cover.webp', 15.99, 0, 'var(--col-eucalyptus)', '2025-05-31 00:29:10'),
(7, 'Rosa Mosqueta', 'Delicada pero con presencia, esta vela con fragancia a rosa mosqueta acompaña muy bien momentos de cuidado personal: una rutina de skincare, una siesta al sol o una tarde de escritura. Su perfume floral aporta una atmósfera elegante y suave, ideal para quienes valoran los pequeños lujos cotidianos.', 1, 'rosehip-cover.webp', 11.99, 15, 'var(--col-rosehip)', '2025-05-31 00:31:47'),
(8, 'Cítrico', 'Brillante, chispeante y con un toque de verano, esta vela cítrica es la compañera perfecta de una limpieza profunda o una mañana de música y ventanas abiertas. Refresca el ánimo y da vida a cualquier espacio con su fragancia alegre y revitalizante, como un jugo recién exprimido en forma de aroma.', 4, 'citric-cover.webp', 12.49, 0, 'var(--col-citric)', '2025-05-31 00:37:04'),
(9, 'Canela', 'Con su aroma cálido y especiado, esta vela de canela transforma cualquier rincón en un refugio invernal. Ideal para acompañar tardes de películas, charlas largas o momentos de introspección, su fragancia invita a bajar el ritmo y disfrutar del presente con una taza de algo caliente entre las manos.', 5, 'cinnamon-cover.webp', 10.99, 5, 'var(--col-cinnamon)', '2025-05-31 00:40:18'),
(10, 'Jazmín', 'Romántica, sutil y exótica, esta vela de jazmín es el detalle perfecto para una cena íntima, una noche de música suave o simplemente para embellecer el día a día. Su fragancia floral y envolvente convierte cualquier espacio en un oasis, ideal para crear atmósferas con un toque de encanto.', 1, 'jasmine-cover.webp', 11.49, 10, 'var(--col-jasmine)', '2025-05-31 00:42:32'),
(11, 'Sándalo', 'Profunda y terrosa, la vela de sándalo es ideal para crear un ambiente introspectivo y sereno. Su aroma levemente amaderado acompaña momentos de meditación, sesiones de yoga o simplemente ese rato en que uno se desconecta del mundo para volver a sí mismo.', 6, 'sandalwood-cover.webp', 12.99, 0, 'var(--col-sandalwood)', '2025-05-31 00:47:42'),
(12, 'Coco', 'Cierra los ojos y dejate llevar a una playa tranquila con esta vela de coco. Perfecta para tardes de verano, momentos de descanso o días en los que el alma pide vacaciones. Su aroma dulce y tropical aporta una vibra relajada y soñadora que combina con hamacas, libros y viento suave.', 7, 'coconout-cover.webp', 12.99, 10, 'var(--col-coconut)', '2025-05-31 00:49:40'),
(13, 'Menta', 'Refrescante y ligera, esta vela de menta es ideal para comenzar el día con una sensación de renovación. Su fragancia revitalizante despeja el ambiente y la mente, acompañando perfectamente una ducha energizante, una sesión de orden o simplemente la necesidad de un nuevo aire.', 3, 'mint-cover.webp', 12.49, 0, 'var(--col-mint)', '2025-05-31 00:51:12'),
(14, 'Naranja y Clavo', 'Una mezcla cálida con toques especiados, esta vela es perfecta para ambientar celebraciones íntimas, cenas en invierno o tardes en las que la casa huele a horno encendido. Su fragancia envolvente y nostálgica transforma el hogar en un espacio lleno de historias y momentos compartidos.', 4, 'orange-and-clove-cover.webp', 13.09, 15, 'var(--col-orange-and-clove)', '2025-05-31 00:53:42'),
(15, 'Frutos Rojos', 'Frutal y vibrante, esta vela es perfecta para animar reuniones con amigas, tardes de arte o simplemente para levantar el ánimo un día gris. Su perfume jugoso y alegre llena de color cualquier ambiente, como una bandeja de frutas frescas sobre la mesa.', 9, 'red-fruits-cover.webp', 11.29, 0, 'var(--col-red-fruits)', '2025-05-31 00:55:19'),
(16, 'Manzana y Canela', 'Ideal para una tarde de otoño o un desayuno largo de domingo, esta vela une lo mejor de dos mundos: lo dulce de la manzana y lo especiado de la canela. Su fragancia invita a quedarse en casa, hornear algo rico y disfrutar del calorcito del hogar.', 9, 'apple-and-cinnamon-cover.webp', 14.99, 0, 'var(--col-apple-and-cinnamon)', '2025-05-31 00:57:52'),
(17, 'Té Verde', 'Sutil y moderno, el aroma a té verde es ideal para espacios donde se busca equilibrio. Esta vela acompaña muy bien sesiones de journaling, mañanas tranquilas o rutinas sin interrupciones. Limpia el ambiente sin recargarlo, dejando una sensación de frescura y orden mental.', 3, 'green-tea-cover.webp', 16.29, 0, 'var(--col-green-tea)', '2025-05-31 00:59:50'),
(18, 'Algodón Fresco', 'Nada dice “casa limpia” como esta vela de algodón fresco. Perfecta para después de ventilar, organizar o simplemente para mantener el ambiente liviano y agradable durante el día. Su aroma neutro, con toques suaves de talco y ropa recién lavada, combina con cualquier rincón.', 8, 'fresh-cotton-cover.webp', 9.99, 5, 'var(--col-fresh-cotton)', '2025-05-31 01:01:26'),
(19, 'Pino', 'La fragancia de pino transforma cualquier espacio en una cabaña entre montañas. Ideal para días fríos, sesiones de escritura o noches en las que querés sentirte lejos de todo sin moverte de casa. Su aroma intenso y natural aporta una sensación de conexión con lo verde y lo esencial.', 6, 'pine-cover.webp', 14.19, 0, 'var(--col-pine)', '2025-05-31 01:02:56'),
(20, 'Chocolate', 'Intensa, tentadora y con un toque divertido, esta vela de chocolate es perfecta para darte un gusto sin culpa. Ideal para acompañar una noche de películas, una merienda especial o un rato de relax total, su aroma dulce y envolvente despierta sonrisas (y antojos, aunque recomendamos fuertemente no comerte la vela).', 2, 'chocolate-cover.webp', 10.99, 5, 'var(--col-chocolate)', '2025-05-31 01:04:19'),
(31, 'Lavanda', 'Nada como terminar el día con una buena dosis de calma: esta vela de lavanda es perfecta para acompañarte en una noche de lectura, una sesión de baño relajante o simplemente para apagar el ritmo del día. Su aroma suave y floral llena el ambiente de serenidad sin imponerse, ideal para quienes buscan desconectar sin esfuerzo.', 1, 'lavender-cover.webp', 11.00, 0, '#b57edc', '2025-06-27 05:36:39');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `candles_details`
--

CREATE TABLE `candles_details` (
  `id` int(10) UNSIGNED NOT NULL,
  `material` varchar(256) NOT NULL,
  `duration` varchar(256) NOT NULL,
  `size` varchar(256) NOT NULL,
  `weight` varchar(256) NOT NULL,
  `fragance` varchar(256) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `candles_details`
--

INSERT INTO `candles_details` (`id`, `material`, `duration`, `size`, `weight`, `fragance`) VALUES
(5, 'Cera vegetal', '45hs', '6cm x 6cm', '200g', 'Vainilla'),
(6, 'Cera vegetal', '30hs', '7cm x 7cm', '250g', 'Eucalipto'),
(7, 'Cera de soja', '40hs', '8cm x 8cm', '180g', 'Rosa Mosqueta'),
(8, 'Cera de soja', '35hs', '8cm x 8cm', '220g', 'Cítrico'),
(9, 'Cera de palma', '45hs', '6,5cm x 6,5cm', '200g', 'Canela'),
(10, 'Cera vegetal', '50hs', '8cm x 8cm', '200g', 'Jazmín'),
(11, 'Cera de palma', '40hs', '7cm x 7cm', '180g', 'Sándalo'),
(12, 'Cera de soja', '35hs', '6,5cm x 6,5cm', '250g', 'Coco'),
(13, 'Cera de palma', '45hs', '7cm x 7cm', '200g', 'Menta'),
(14, 'Cera de abejas', '40hs', '9cm x 9cm', '180g', 'Naranja y Clavo'),
(15, 'Cera de palma', '30hs', '7cm x 7cm', '200g', 'Frutos Rojos'),
(16, 'Cera de palma', '35hs', '9cm x 9cm', '220g', 'Manzana y Canela'),
(17, 'Cera de soja', '35hs', '7cm x 7cm', '250g', 'Té Verde'),
(18, 'Cera vegetal', '45hs', '6cm x 6cm', '200g', 'Algodón Fresco'),
(19, 'Cera vegetal', '50hs', '7cm x 7cm', '250g', 'Pino'),
(20, 'Cera de abejas', '35hs', '7cm x 7cm', '220g', 'Chocolate'),
(31, ' Cera de soja ', '40 horas', ' 6cm x 6cm ', ' 200g ', 'Lavanda');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `candles_x_tags`
--

CREATE TABLE `candles_x_tags` (
  `id` int(10) UNSIGNED NOT NULL,
  `id_candle` int(10) UNSIGNED NOT NULL,
  `id_tag` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `candles_x_tags`
--

INSERT INTO `candles_x_tags` (`id`, `id_candle`, `id_tag`) VALUES
(8, 13, 8),
(11, 19, 9),
(12, 16, 9),
(52, 5, 8),
(53, 5, 9);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categories`
--

CREATE TABLE `categories` (
  `id` int(10) UNSIGNED NOT NULL,
  `category` varchar(256) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `categories`
--

INSERT INTO `categories` (`id`, `category`) VALUES
(1, 'Floral'),
(2, 'Dulce'),
(3, 'Herbal'),
(4, 'Cítrica'),
(5, 'Especiada'),
(6, 'Amaderada'),
(7, 'Tropical'),
(8, 'Limpia'),
(9, 'Frutal');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `extra_images`
--

CREATE TABLE `extra_images` (
  `id` int(10) UNSIGNED NOT NULL,
  `filename` varchar(256) NOT NULL,
  `id_candle` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `extra_images`
--

INSERT INTO `extra_images` (`id`, `filename`, `id_candle`) VALUES
(7, 'vanilla-2.webp', 5),
(8, 'vanilla-3.webp', 5),
(9, 'eucalyptus-2.webp', 6),
(10, 'eucalyptus-3.webp', 6),
(11, 'rosehip-2.webp', 7),
(12, 'rosehip-3.webp', 7),
(13, 'citric-2.webp', 8),
(14, 'citric-3.webp', 8),
(15, 'cinnamon-2.webp', 9),
(16, 'cinnamon-3.webp', 9),
(17, 'jasmine-2.webp', 10),
(18, 'jasmine-3.webp', 10),
(19, 'sandalwood-2.webp', 11),
(20, 'sandalwood-3.webp', 11),
(21, 'sandalwood-4.webp', 11),
(22, 'coconout-2.webp', 12),
(23, 'coconout-3.webp', 12),
(24, 'mint-2.webp', 13),
(25, 'mint-3.webp', 13),
(26, 'orange-and-clove-2.webp', 14),
(27, 'orange-and-clove-3.webp', 14),
(28, 'red-fruits-2.webp', 15),
(29, 'red-fruits-3.webp', 15),
(30, 'apple-and-cinnamon-2.webp', 16),
(31, 'apple-and-cinnamon-3.webp', 16),
(32, 'green-tea-2.webp', 17),
(33, 'green-tea-3.webp', 17),
(34, 'fresh-cotton-2.webp', 18),
(35, 'fresh-cotton-3.webp', 18),
(36, 'pine-2.webp', 19),
(37, 'pine-3.webp', 19),
(38, 'chocolate-2.webp', 20),
(39, 'chocolate-3.webp', 20),
(75, 'lavender-2.webp', 31),
(76, 'lavender-3.webp', 31);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tags`
--

CREATE TABLE `tags` (
  `id` int(10) UNSIGNED NOT NULL,
  `tag` varchar(256) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `tags`
--

INSERT INTO `tags` (`id`, `tag`) VALUES
(8, 'Destacados'),
(9, 'Meditación');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `full_name` varchar(256) NOT NULL,
  `email` varchar(256) NOT NULL,
  `password` varchar(256) NOT NULL,
  `rol` enum('customer','admin','superadmin','') NOT NULL,
  `date_created` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`id`, `full_name`, `email`, `password`, `rol`, `date_created`) VALUES
(1, 'Nicolas Leonel Corbalan', 'nicolas.lcorbalan@davinci.edu.ar', '$2y$10$BTvHpBshmHTF.Yoqn.ixNO39RLlcT0l1gpuVpGuyhVBQeQ91I17RG', 'superadmin', '2025-06-19 20:50:46'),
(2, 'Agueda Rafaela Roda', 'memer@gmail.com', '$2y$10$p4vyT9e.V.x5AFKeeHgcyuz6twZXynqkgg8Oqo3UpeAKlEv30Nhuy', 'customer', '2025-06-19 21:58:43'),
(3, 'Antonio Nehuen Villar', 'antoniopro@gmail.com', '$2y$10$CwTHfpWOpQ/YBGYdcYvTje6ENgD2sAhbsiV6Xt3T0/4w4MYUmg2cq', 'admin', '2025-06-20 04:08:42');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `views`
--

CREATE TABLE `views` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(256) NOT NULL,
  `title` varchar(256) NOT NULL,
  `active` tinyint(1) NOT NULL,
  `restricted` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `views`
--

INSERT INTO `views` (`id`, `name`, `title`, `active`, `restricted`) VALUES
(1, 'catalog', 'Nuestros Productos', 1, 0),
(2, 'contact', 'Contacto', 1, 0),
(3, 'about-us', 'Sobre Nosotros', 1, 0),
(4, 'product-detail', 'Detalle de producto', 1, 0),
(5, 'contact-response', 'Consulta enviada', 1, 0),
(6, 'student', 'Alumno', 1, 0),
(8, 'admin-products', 'Administrar productos', 1, 1),
(9, 'admin-categories', 'Administrar categorías', 1, 1),
(10, 'admin-tags', 'Administrar equiquetas', 1, 1),
(11, 'admin-users', 'Administrar usuarios', 1, 1),
(12, 'add-product', 'Añadir producto', 1, 1),
(13, 'add-user', 'Añadir usuario', 1, 1),
(14, 'login', 'Iniciar sesión', 1, 0),
(15, '403', 'Acceso denegado', 1, 0),
(16, 'edit-product', 'Editar producto', 1, 1),
(17, 'cart', 'Carrito', 1, 0),
(18, 'checkout', 'Completar Compra', 1, 0),
(19, 'user-panel', 'Panel de Usuario', 1, 0);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `candles`
--
ALTER TABLE `candles`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_category` (`id_category`);

--
-- Indices de la tabla `candles_details`
--
ALTER TABLE `candles_details`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `candles_x_tags`
--
ALTER TABLE `candles_x_tags`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_candle` (`id_candle`),
  ADD KEY `id_tags` (`id_tag`);

--
-- Indices de la tabla `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `extra_images`
--
ALTER TABLE `extra_images`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_candle` (`id_candle`);

--
-- Indices de la tabla `tags`
--
ALTER TABLE `tags`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `views`
--
ALTER TABLE `views`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `candles`
--
ALTER TABLE `candles`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT de la tabla `candles_x_tags`
--
ALTER TABLE `candles_x_tags`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=54;

--
-- AUTO_INCREMENT de la tabla `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT de la tabla `extra_images`
--
ALTER TABLE `extra_images`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=101;

--
-- AUTO_INCREMENT de la tabla `tags`
--
ALTER TABLE `tags`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `views`
--
ALTER TABLE `views`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `candles`
--
ALTER TABLE `candles`
  ADD CONSTRAINT `candles_ibfk_1` FOREIGN KEY (`id_category`) REFERENCES `categories` (`id`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `candles_details`
--
ALTER TABLE `candles_details`
  ADD CONSTRAINT `candles_details_ibfk_1` FOREIGN KEY (`id`) REFERENCES `candles` (`id`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `candles_x_tags`
--
ALTER TABLE `candles_x_tags`
  ADD CONSTRAINT `candles_x_tags_ibfk_1` FOREIGN KEY (`id_candle`) REFERENCES `candles` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `candles_x_tags_ibfk_2` FOREIGN KEY (`id_tag`) REFERENCES `tags` (`id`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `extra_images`
--
ALTER TABLE `extra_images`
  ADD CONSTRAINT `extra_images_ibfk_1` FOREIGN KEY (`id_candle`) REFERENCES `candles` (`id`) ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
