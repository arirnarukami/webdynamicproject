-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 11, 2019 at 06:14 PM
-- Server version: 10.4.6-MariaDB
-- PHP Version: 7.3.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_webpbp_new`
--

-- --------------------------------------------------------

--
-- Table structure for table `kategori`
--

CREATE TABLE `kategori` (
  `idkategori` int(4) UNSIGNED NOT NULL,
  `nama_kategori` varchar(20) NOT NULL,
  `detail` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `kategori`
--

INSERT INTO `kategori` (`idkategori`, `nama_kategori`, `detail`) VALUES
(4, 'Accessories', NULL),
(2, 'HandPhone', NULL),
(3, 'Monitor', NULL),
(1, 'PC/Laptop', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `pegawai`
--

CREATE TABLE `pegawai` (
  `idpegawai` int(4) UNSIGNED NOT NULL,
  `username` varchar(15) NOT NULL,
  `nama_lengkap` varchar(50) NOT NULL,
  `email` varchar(20) NOT NULL,
  `password` varchar(12) NOT NULL,
  `level` char(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pegawai`
--

INSERT INTO `pegawai` (`idpegawai`, `username`, `nama_lengkap`, `email`, `password`, `level`) VALUES
(1, 'arya', 'Aryarafi', 'dummy2@email.com', 'password01', 'B'),
(2, 'ainun', 'ainun herlambang', 'ainunherlambang@gmai', 'ainun123', 'A'),
(3, 'johan', 'johanadi', 'johan@gmail.com', 'johan01', 'B'),
(4, 'arir', 'Syahrir', 'dummy1@email.com', '123', 'A'),
(6, 'ipul', 'ipul', 'io@m.com', '456', 'A');

-- --------------------------------------------------------

--
-- Table structure for table `produk`
--

CREATE TABLE `produk` (
  `idproduk` int(12) UNSIGNED NOT NULL,
  `idsubkategori` int(6) UNSIGNED NOT NULL,
  `idkategori` int(4) UNSIGNED NOT NULL,
  `nama_produk` varchar(50) NOT NULL,
  `deskripsi` varchar(1000) DEFAULT NULL,
  `gambar_produk` varchar(50) DEFAULT NULL,
  `harga` int(10) DEFAULT NULL,
  `last_update` datetime NOT NULL DEFAULT current_timestamp(),
  `idpegawai` varchar(11) NOT NULL,
  `stok` int(4) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `produk`
--

INSERT INTO `produk` (`idproduk`, `idsubkategori`, `idkategori`, `nama_produk`, `deskripsi`, `gambar_produk`, `harga`, `last_update`, `idpegawai`, `stok`) VALUES
(1, 1, 1, 'Laptop Asus A409FJ', 'Processor i5 8265U\r\nRAM 8GB DDR4\r\nStorage 1 TB HDD ( available m2 ssd )\r\nOS Windows 10 Home\r\nGraphics Card Dedicated NVIDIA MX230 2Gb GDDR5\r\nDisplay 14\'\'\" (16:9) LED backlit FHD (1920X1080) Glare, Ultra Slim 200nits\r\nPorts 1x Microphone-in/Headphone-out jack, 1x USB 3.0 port, 1x HDMI, 1x MicroSD card reader, 1x USB 2.0 Port\r\nConnectivity Integrated 802.11b/g/n + Bluetooth v4.0\r\nBattery 3 cell Li-ion, 33WHrs\r\nIncludes 2 year warranty, VGA Web Camera, ASUS SonicMaster Technology, Fingerprint', 'Laptop_Asus_A409FJ.jpg', 8600000, '2019-10-17 02:35:27', '001', 9),
(2, 1, 1, 'Laptop Dell 3585', 'Processor Onboard : AMD Ryzen™ 5 2500U Mobile Processor 2.0 GHz (2 M Cache, up to 3.6 GHz)\nMemori Standar : 4GB, 4GBx1, DDR4 2666MHz\nTipe Grafis : Radeon™ Vega 8 Graphics\nDisplay : 15.6-inch Full HD (1920x1080) Anti-Glare LED Backlit\nHard Disk : 1TB HDD 5400RPM\nWebcam : Integrated widescreen HD (720p)\nWireless Network : 802.11ac + Bluetooth 4.1; Dual Band 2.4&5Ghz 1×1\nDVD : Tray load DVD Drive (Reads and Writes to DVD/CD)\nKeyboard : Standard full size spill-resistant keyboard 10-key numeric keypad', 'Laptop_Dell_3585.jpg', 5800000, '2019-10-17 02:35:34', '001', 10),
(3, 1, 1, 'Laptop Acer Swift 3', 'Processor: AMD Athlon 300U dual-core processor with 4 Threads, 2.4 Ghz turbo up to 3.3 Ghz\nMemory & Storage : 8GB DDR4 RAM\nSSD M2 256GB Nvme\nOperating System: Windows 10 Home 64 bit\nDisplay & Graphics: 14\" display with IPS(In-Plane Switching)\nAMD Radeon Vega 3 Mobile Graphics with 3 GPU cores\nDesign & Battery: Device weights 1.5kgs light , Full Metal Body | Battery life up to 10 hours', 'Laptop_Acer_Swift3.jpg', 6750000, '2019-10-17 02:35:39', '001', 15),
(4, 2, 1, 'Laptop ROG Zephyrus M', 'Processor Onboard : Intel® Core™ i7-9750H Processor 2.6GHz (12M Cache, up to 4.5GHz)\nMemori Standar : 8 GB DDR4 2666Hz SDRAM, SO-DIMM socket for expansion, up to 24 GB SDRAM, Dual-channel\nTipe Grafis : Intel UHD 630 + NVIDIA® GeForce GTX™ 1660Ti with 6GB GDDR6 VRAM\nChipset : Mobile Intel® HM370 Express Chipsets\nUkuran Layar : 15.6\" (16:9) LED-backlit FHD (1920x1080) Anti-Glare IPS-level 144Hz Panel with 72% NTSC\n300 Nits 100% SRGB\nHard Disk : 512GB SSD NVME PCIe\nKeyboard : IIlluminated Chiclet Keyboard Per-Key RGB', 'Laptop_ROG_Zephyrus_M.jpg', 25000000, '2019-10-17 02:35:46', '001', 4),
(5, 2, 1, 'Laptop MSI GF63', 'Intel® Core™ i5-9300H Processor hexa-core 2,4GHz TurboBoost hingga 4,1GHz, 12M Cache\nMemori RAM 8GB DDR4\nStorage 256GB NVme SSD\nScreen 15.6\" FHD (1920 x 1080) IPS-Level 60Hz 45%NTSCThin Bezel\nMetallic top and keyboard cover paired with an unique X-shaped ventilation hidden underneath\nNVIDIA® GeForce® GTX 1650 4GB GDDR5\n1x Type-C USB3.1 gen 2 \n3x Type-A USB 3.1 gen1 \n1x RJ45 1x HDMI (4K 30Hz)\nIntel Wireless-AC 9462 (1*1 a/c)+ \nBluetooth V5.0, HD Webcam\n1x Mic In 1x Headphone Out\n2x2W Speaker\nExclusive Audio Boost Technology Nahimic Audio Enhancer\nGenuine Windows 10', 'Laptop_MSI_GF63.jpg', 13600000, '2019-10-17 02:35:52', '001', 8),
(6, 2, 1, 'Laptop Razer Blade 15', 'Processor: Intel Core i7-8750H\nGraphics: Nvidia GeForce GTX1070 8GB\nMemory: 16GB DDR4-2,667MHz\nDisplay: 15.6-inch IPS 144Hz\nResolution: 1920x1080\nStorage: 512GB SSD\nBattery: 80Wh\nConnectivity: 1 x Thunderbolt 3 (USB-C), 3 x USB Type-A 3.1 Gen 1, Mini DisplayPort 1.4, HDMI 2.0\nOS: Windows 10 Home\nDimensions: 0.78 x 13.98 x 9.25 inches\nWeight: 4.63 pounds \nGaransi 1 tahun distributor', 'Laptop_Razer_Blade_15.jpg', 32900000, '2019-10-17 02:35:58', '001', 3),
(7, 3, 1, 'Laptop Microsoft Surface Book 2', 'Screen Size 13.5 inches\nMax Screen Resolution 3000x2000 pixels\nProcessor 7th Gen Intel® Core™ i5-7300U dual-core processor, 3.5GHz Max Turbo\nRAM 8 GB LPDDR3\nMemory Speed 1866 MHz\nGraphics Coprocessor HD Graphics 620\nChipset Brand Intel\nGraphics Card Ram Size 2 GB\nWireless Type 802.11abg\nNumber of USB 2.0 Ports 1\nNumber of USB 3.0 Ports 2\nOperating System Windows 10 Pro\nProduct Dimensions 12.3 x 9.1 x 0.9 inches\nItem Dimensions L x W x H 12.3 x 9.14 x 0.9 inches\nRear Webcam Resolution 8 MP\nProcessor Brand Intel\nProcessor Count 2\nFlash Memory Size 256', 'Laptop_Microsoft_Surface_Book_2.jpg', 30000000, '2019-10-17 02:36:08', '001', 4),
(8, 3, 1, 'Laptop HP Spectre X360', 'processor i7 8565U (1.8 GHz base frequency(2b), up to 4.6 GHz with Intel Turbo Boost Technology(2g), 8 MB cache, 4 cores)\nRam 16GB DDR4-2400 SDRAM (onboard)\nIntel UHD Graphics 620\nHDD 1TB PCIe NVMe™ M.2 SSD\n13.3\" diagonal 4K IPS BrightView micro-edge WLED-backlit touch screen (3840 x 2160)\nKeyboard Full-size island-style backlit keyboard\nPointing device HP Imagepad with multi-touch gesture support\nWireless connectivity Intel Wireless-AC 9560 802.11a/b/g/n/ac (2x2) Wi-Fi and Bluetooth® 5 Combo\nExpansion slots 1 microSD media card reader\nExternal ports 2x USB Type-C™ 3.1 Gen 2 (Thunderbolt™ 3, DP 1.2, PD 3.0, Data transfer, HP Sleep and Charge ); 1x USB 3.1 Gen2 Type-A™ (HP Sleep and Charge); 1 headphone/microphone combo\nMinimum dimensions (W x D x H) 30.88 x 21.79 x 1.45 cm\nWeight Starting at 1.32 kg', 'Laptop_HP_Spectre_X360.jpg', 26500000, '2019-10-17 02:36:13', '001', 6),
(9, 3, 1, 'Laptop Lenovo Yoga 520', 'Processor Intel 8th Core i3 8130U 2.5GHz (3MB Cache)\n8GB RAM DDR4 (Max. 16GB)\n1TB HDD (M.2 PCIe SSD Slot Available)\nIntel HD Graphics 620 & nVidia GeForce MX130 2GB\nWindows 10 Home 64bit\n14\"IPS FHD Multi Touchscreen LED Display 360 rotation hinge\nProfessional Audio by Harman with Dolby Premium\nHD Webcam, Card Reader, WiFi 802.11ac, Bluetooth v4.1\nHeadphone Jack, Microphone\n1x HDMI, 2x USB 3.0 & 1x USB 3.1\nWeight : 1.74kg up to 8 hours\nGaransi Resmi PT. Lenovo Indonesia 2 Tahun\nNon DVD RW ', 'Laptop_Lenovo_Yoga_520.jpg', 8300000, '2019-10-17 02:36:19', '001', 11),
(10, 4, 2, 'HP Nokia 103', 'Display Type Monochrome graphic\nSize 1.36 inches (~11.6% screen-to-body ratio)\nResolution 96 x 68 pixels (~87 ppi pixel density)\nMemory Card slot No\nPhonebook 500 entries\nCall records Yes\nCamera No\nSound Alert types Vibration; Polyphonic(32)\nLoudspeaker Yes\n3.5mm jack Yes\nComms WLAN No\nBluetooth No\nGPS No\nRadio Stereo FM radio\nUSB No\nFeatures Messaging SMS\nBrowser No\nGames Yes\nJava No\nBattery Removable Li-Ion 800 mAh battery (BL-5CB)\nStand-by Up to 648 h\nTalk time Up to 11 h\nMisc Colors Blue/Orange', 'HP_Nokia_103.jpg', 165000, '2019-10-17 02:36:28', '002', 20),
(11, 4, 2, 'HP Brandcode B1', 'Single SIM Card\nCalculator\nCalendar\nMemo\nAlarm\nWorld Clock timer\nLCD black n white\nCharger\nBattery\nKartu Garansi', 'HP_Brandcode_B1.jpg', 76000, '2019-10-17 02:36:35', '002', 15),
(12, 4, 2, 'HP Nokia 1280', 'Dual  SIM Card\nCalculator\nCalendar\nMemo\nAlarm\nWorld Clock timer\nLCD black n white\nCharger\nBattery\nKartu Garansi', 'HP_Nokia_1280.jpg', 156000, '2019-10-17 02:36:43', '002', 14),
(13, 5, 2, 'HP Nokia N110', 'Network GSM 900 / 1800.\nTipe TFT, 56K colors\nUkuran 148 x 180 pixels, 2 inches (~114 ppi pixel density)\nTipe 10 x 46 x 14.5 mm, 63 cc / 80 g\nFitur Vibration; Polyphonic Ringtones\nJack 3.5mm jack audio\nSpeakerphone Ya\nInternal 64 MB\nEksternal SLOT Micro SD card up to 32GB\nEDGE Ya\nGPRS Ya\nBluetooth v2.1 with A2DP, EDR\nPrimer VGA, 640x480 pixels\nVideo Record Ya, 176x144@15fps\nTipe Standard battery, Li-Ion 1020mAh (BL-5C)\nStanby Up to 636 h\nTalk Time Up to 10 h 30 min', 'HP_Nokia_N10.jpg', 165000, '2019-10-17 02:36:53', '002', 10),
(14, 5, 2, 'HP Nokia 130', 'Network GSM 900 / 1800.\nTipe TFT, 56K colors\nUkuran 128 x 160 pixels, 1.8 inches (~114 ppi pixel density)\nTipe 10 x 46 x 14.5 mm, 63 cc / 80 g\nFitur Vibration; Polyphonic Ringtones\nJack 3.5mm jack audio\nSpeakerphone Ya\nInternal 64 MB\nEksternal SLOT Micro SD card up to 32GB\nEDGE Ya\nGPRS Ya\nBluetooth v2.1 with A2DP, EDR\nPrimer VGA, 640x480 pixels\nVideo Record Ya, 176x144@15fps\nTipe Standard battery, Li-Ion 1020mAh (BL-5C)\nStanby Up to 636 h\nTalk Time Up to 10 h 30 min', 'HP_Nokia_130.jpg', 155000, '2019-10-17 02:36:59', '002', 13),
(15, 5, 2, 'HP Nokia 216', 'Network GSM 900 / 1800.\nTipe TFT, 56K colors\nUkuran 228 x 260 pixels, 3 inches (~114 ppi pixel density)\nTipe 10 x 46 x 14.5 mm, 63 cc / 80 g\nFitur Vibration; Polyphonic Ringtones\nJack 3.5mm jack audio\nSpeakerphone Ya\nInternal 124 MB\nEksternal SLOT Micro SD card up to 32GB\nEDGE Ya\nGPRS Ya\nBluetooth v2.1 with A2DP, EDR\nPrimer VGA, 640x480 pixels\nVideo Record Ya, 176x144@15fps\nTipe Standard battery, Li-Ion 1020mAh (BL-5C)\nStanby Up to 636 h\nTalk Time Up to 10 h 30 min', 'HP_Nokia_216.jpg', 265000, '2019-10-17 02:37:08', '002', 10),
(16, 6, 2, 'HP Samsung Galaxy A50', 'SIM Single SIM (Nano-SIM) or Dual SIM (Nano-SIM, dual stand-by)\nSize 6.4 inches, 100.5 cm2 (~84.9% screen-to-body ratio)\nPLATFORM OS Android 9.0 (Pie)\nChipset Exynos 9610 Octa (10nm)\nCPU Octa-core (4x2.3 GHz Cortex-A73 & 4x1.7 GHz Cortex-A53)\nGPU Mali-G72 MP3\nInternal 64 GB, 4 GB RAM\nMAIN CAMERA Triple 25 MP, 8 MP, 5 MP,\nSELFIE CAMERA Single 25 MP\nBATTERY Non-removable Li-Po 4000 mAh battery ', 'HP_Samsung_A50.jpg', 3200000, '2019-10-17 02:37:17', '002', 7),
(17, 6, 2, 'HP Xiaomi Redmi Note 7', 'SIM Hybrid Dual SIM (Nano-SIM, dual stand-by)\nSize 6.3 inches, 97.4 cm2 (~81.4% screen-to-body ratio)\nPLATFORM OS Android 9.0 (Pie); MIUI 10\nChipset Qualcomm SDM660 Snapdragon 660 (14 nm)\nCPU Octa-core (4x2.2 GHz Kryo 260 & 4x1.8 GHz Kryo 260)\nGPU Adreno 512\nInternal 64 GB, 4 GB RAM\nMAIN CAMERA Dual 48 MP,5 MP,\nSELFIE CAMERA Single 13 MP, f/2.2, 1.25µm\nBATTERY Non-removable Li-Po 4000 mAh battery ', 'HP_Xiaomi_Redmi_Note_7.jpg', 2500000, '2019-10-17 02:37:25', '002', 19),
(18, 6, 2, 'HP Asus Max M2', 'SIM Dual SIM (Nano-SIM, dual stand-by)\nSize 6.26 inches,\nPLATFORM OS Android 8.1 (Oreo)\nChipset Qualcomm SDM632 Snapdragon 632 (14 nm)\nCPU Octa-core (4x1.8 GHz Kryo 250 Gold & 4x1.8 GHz Kryo 250 Silver)\nGPU Adreno 506\nInternal 32 GB, 3 GB RAM\nMAIN CAMERA Dual 13 MP\nSELFIE CAMERA Single 8 MP,\nBATTERY Non-removable Li-Ion 4000 mAh battery ', 'HP_Asus_Max_M2.jpg', 1700000, '2019-10-17 02:37:33', '002', 10),
(19, 7, 3, 'Monitor Samsung 15 inch', 'Resolusi 15 inchDimension 15.6 inch\nWarna Putih\nTipe tabung\nMerek Samsung\nSlot VGA\nUntuk penggunaan pribadi atau koleksi barang antik', 'Monitor_Samsung_15.jpg', 265000, '2019-10-17 02:37:48', '003', 7),
(20, 8, 3, 'Monitor LG 24 Inch', 'Size (Inch) 23.8\nPanel Type IPS\n75HZ Refesh Rate\nResponse Time 1MS\nColor Depth(Number of Colors) 16.7M Colors Pixel Pitch(mm) 0.2745x0.2745 Aspect Ratio 16:9\nResolution 1920 x 1080\nBrightness(Typ.) 250cd/m2\nContrast Ratio(Original) 1000:1\nViewing Angle(CR10) 178/178 ', 'Monitor_LG_24.jpg', 1880000, '2019-10-17 02:38:30', '003', 10),
(21, 8, 3, 'Monitor Dell 24 Inch Touch', 'LED-backlit LCD monitor - 24\" - touchscreen\nFeatures\nUSB hub\nPanel Type\nIPS\nAspect Ratio\nWidescreen - 16:9\nNative Resolution\nFull HD (1080p) 1920 x 1080 at 60 Hz\nPixel Pitch\n0.275 mm\nBrightness\n250 cd/m\nContrast Ratio\n1000:1 / 8000000:1 (dynamic)\nResponse Time\n6 ms (gray-to-gray)\nColor Support\n16.7 million colors\nInput Connectors\nHDMI, VGA, DisplayPort\nDisplay Position Adjustments\nHeight, swivel, tilt\nScreen Coating\nAnti-glare, 3H Hard Coating\nColor\nBlack\nDimensions (WxDxH) - with stand\n21.2 in x 9.3 in x 12.7 in\nWeight\n6.88 lbs\nEnvironmental Standards\nENERGY STAR Qualified\nCompliant Standards\nRoHS, TCO Displays\nManufacturer Warranty\n3 years warranty\nBundled Services\n3-Years Advanced Exchange Service and Premium Panel Guarantee', 'Monitor_Dell_24_Touch.jpg', 4450000, '2019-10-17 02:38:39', '003', 2),
(22, 8, 3, 'Monitor HP 22 Inch', 'Display size (diagonal)54.61 cm (21.5”)\nPanel active area47.6 x 26.78 cm\nDisplay type IPS with LED backlight\nAspect ratio 16:9\nNative resolution FHD (1920 x 1080 @ 60 Hz)\nDisplay features\nAnti-glare\nAnti-static\nIn plane switching\nLanguage selection\nLED backlights\nOn-screen controls\nPlug and Play\nUser programmable', 'Monitor_HP_22.jpg', 1680000, '2019-10-17 02:38:47', '003', 16),
(23, 9, 3, 'Monitor Samsung 24 Inch Curve', 'SCREEN SIZE 23.5\"\nRESOLUTION 1920 x 1080\nDYNAMIC CONTRAST\nRATIO Mega DCR\nFull SpecificationsDisplayMODEL NUMBERLS24E510CS/ZASCREEN\nFeatures\nVGA: 1\nHDMI: 1\nWALL MOUNTABLE : Yes\nSTAND: Curved T-Shape\nWALL-MOUNT (SIZE MM):100mm x 100mm\nMAGIC PICTURE CONTROLS:MagicUpscale, MagicBright\nMAC COMPATIBLE:Yes\nWINDOWS COMPATIBLE:Yes\nSAMSUNG MAGICBRIGHT:Yes\nSAMSUNG MAGICUPSCALE:Yes\nECO SAVING PLUS:Yes\nEYE SAVER MODE:Yes\nFLICKER FREE:Yes\nFreesync: YES\nGAME MODE:Yes\nIMAGE SIZE:Yes', 'Monitor_Samsung_24_Curve.jpg', 1550000, '2019-10-17 02:38:54', '003', 12),
(24, 9, 3, 'Monitor Philips 27 Inch Curve', 'LCD panel type\nVA LCD\nBacklight type\nW-LED system\nPanel Size\n27 inch / 68.6 cm\nEffective viewing area\n597.9 (H) x 336.3 (V) - at a 1800 R curvature*\nAspect ratio\n16:9\nOptimum resolution\n1920 x 1080 @ 60 Hz\nResponse time (typical)\n4 ms (Gray to Gray)*\nBrightness\n250 cd/m\nContrast ratio (typical)\n3000:1\nSmartContrast', 'Monitor_Philips_27_Curve.jpg', 3500000, '2019-10-17 02:39:01', '003', 5),
(25, 9, 3, 'Monitor MSI 24 Inch Curve', 'Type / Size : 23.6“ (59.94 cm)\nActive Display Area (mm) : 521.395 (H) x 293.285 (V)\nCurvature : 1500R\nPanel Type : Samsung VA\nResolution : 1920 x 1080 (FHD)\nPixel pitch : 0.27156 (H) x 0.27156 (V)\nAspect Ratio : 16:9\nBrightness (nits) : 300\nContrast Ratio : 3000:1\nDCR (Dynamic Contrast Ratio) : 100000000:1', 'Monitor_MSI_24_Curve.jpg', 4000000, '2019-10-17 02:39:12', '003', 3),
(26, 10, 4, 'Headset Sades Mpower', 'Loudhailer diameter : 50 mm\nSensitivity : 98 ± 3 dB at 1 kHz\nFrequency response : 20~20,000 Hz\nImpedance : 32 ? at 1 kHz\nHandling Power Capacity : 20 mW\nMICROPHONE\nDimension : 4*1.5 mm\nSensitivity : -47 ± 3 dB at 1 kHz\nFrequency response : 100~10,000 Hz\nImpedance : ? 2.2 K? at 1 kHz\nDirectivity: omnidirectional\nWEIGHT/BOX SIZE/EAN CODE\nWeight(Headset only):300 g/0.66 lb\nWeight (Headset & Package): 620 g/1.37 lb\nBox Size: 220*110*240 mm/8.66*4.33*9.45 in\nEAN Code: 6956766907890', 'Headset_Sades_MPower.jpg', 350000, '2019-10-17 02:39:46', '003', 20),
(27, 10, 4, 'Headset Steelseries Arctic 1', 'Headphone Frequency Response : 20–20000?Hz\nHeadphone Sensitivity : 100?db\nHeadphone Impedance : 32?Ohm\nHeadphone Total Harmonic Distortion : < 3%\nHeadphone Volume Control : On Ear Cup\nFrequency Response : 100Hz–10000Hz\nType : Noise Canceling Bidirectional\nSensitivity : -38?db\nConnection : Detachable\nMicrophone Mute Toggle : On Ear Cup\nConnector Type : 4-pole 3.5mm + Dual 3.5mm PC extension\nCable Length : 3?m / 10?ft\nCable Material : Rubber', 'Headset_Steelseries_Arctic_1.jpg', 790000, '2019-10-17 02:39:53', '003', 10),
(28, 10, 4, 'Headset Rexus F55', 'Speaker besar 40mm, suara stereo yang kuat.\nDengan cahaya LED, membuat lebih bersemangat\nDengan desain busa kepala yang dapat disesuaikan\nBerbahan kulit imitasi pada bantalan telinga.\nNyaman dan lebih unggul dalam peredam.\nKabel dengan jack tunggal 3.5 mm dan dilengkapi dengan adapter konverter\nTersedia warna\nHitam lsit Orange\nHitam list Biru\nHitam list Merah\nGaransi Resmi Rexus 1 Tahun...', 'Headset_Recus_F55.jpg', 155000, '2019-10-17 02:40:00', '003', 30),
(29, 13, 4, 'Mic Clip On', 'Mic +Clip dengan busa penyaring suara.\nPanjang total : sekitar 1m Sampai 1,5m tergantung kiriman dari pabrik kadang berubah2. No komplain.\nWarna : Hitam saja. No warranty, no return.', 'Mic_Clip_On.jpg', 8000, '2019-10-17 02:40:17', '003', 35),
(30, 13, 4, 'Mic & Stand', 'Frekuensi Respon 50mhz-16khz\nSensitivity -55db +- 2db\nImpedance 2.2K\nSignal to Noise Ratio More Than 36db\nDimensi Cord Length: 2 Meters\nLain-lain Sensitivity Reduction: Within -3db At 1V\nTipe Baterai Operatin Voltage: 1.5V Standard Operation Voltage: 1.5V', 'Mic_&_Stand.jpg', 145000, '2019-10-17 02:40:23', '003', 20),
(31, 13, 4, 'Mic Taffware BM800', 'Professional condenser microphone\nShock proof mount\nHi-Quality Microphone\nWindshield\nincludes:\n1x professional condenser studio microphone\n1x windshield\n1x shockproof mount\n1x XLR cable', 'Mic_Taffware_BM800.jpg', 120000, '2019-10-17 02:40:29', '003', 17),
(32, 11, 4, 'Mouse Logitech G103', 'Sensor 200-8.000 DPI\nMemori pada Perangkat\nPencahayaan RGB yang Dapat Diprogram (Pilih lebih dari 16,8 juta warna)\nEnam tombol yang dapat diprogram\nPeralihan DPI dalam sekejap mata\nPenelusuran\nResolusi: 200 8.000 dpi\nMaks. akselerasi: >25G*\nMaks. kecepatan: >200 ips*', 'Mouse_Logitech_G103.jpg', 270000, '2019-10-17 02:40:41', '003', 13),
(33, 11, 4, 'Mouse Sades Axe', 'Ergonomic, Right-Handed\nGrip Style: Claw, Fingertip\nButtons: 12\nLength: 124 mm/4.88 in\nWidth: 79 mm/3.12 in\nHeight: 43.5 mm/1.72 in\nCable Length: Approx. 1.8 m/5.91 ft\nInput Plug: Gold-plated USB Plug\nBuilt-in Memory: 32k built-in memory\nSensor Name: PMW 3325\nSensor Type: Optical\nCPI: 200-10,000\nFootpad Lifespan: 500 kms\nMaximum Acceleration: 20 G\nMaximum Speed: 100 in/s\nReport Rate: 125/250/500/1000 Hz (Default Value: 500 Hz)', 'Mouse_Sades_Axe.jpg', 345000, '2019-10-17 02:40:47', '003', 10),
(34, 11, 4, 'Mouse Razer Basilisk', 'True 16,000 DPI 5G optical sensor\nOutfitted with the worlds most advanced Razer 5G optical sensor with true 16,000 DPI\nthe Razer Basilisk gives you unrivaled precision and performance.\nCustomizable scroll wheel resistance\nThe Razer Basilisk comes with a dial that lets you tweak the resistance of the scroll wheel.\nWith your personalized sensitivity, you will be able to more accurately perform bunny hops, weapon selects, zeroing and other scroll wheel actions.', 'Mouse_Razer_Basilisk.jpg', 1250000, '2019-10-17 02:40:53', '003', 4),
(35, 12, 4, 'Keyboard Logitech MK240 Wireless + Mouse', 'Dimensi\nKeyboard:\nTinggi x Lebar x Tebal: 5,47 inci (139 mm) x 11,34 inci (288 mm) x 0,83 inci (21 mm)\nBerat: 11,0 oz (312 g)\n\nMouse:\nTinggi x Lebar x Tebal: 2,36 inci (60 mm) x 3,94 inci (100 mm) x 1,26 inci (32 mm)\nBerat: 1,9 oz (53 g)\n\nPERSYARATAN SISTEM\nWindows® 10 atau versi terbaru, Windows8, Windows 7, Windows Vista®, Windows XP\nChrome OS™\nPort USB\nKoneksi Internet (untuk mengunduh software tambahan)\n\nGaransi 1 Tahun - Jaminan Produk Original dan Bergaransi Resmi Logitech Indonesia Claim garansi beserta packaging. ', 'Keyboard_Logitech_M220.jpg', 240000, '2019-10-17 02:40:59', '003', 18),
(36, 12, 4, 'Keyboard Imperion Mech 7 Mechanical', 'Blue Kaihl Switches Mechanical Keyboard\nBuilt For confort and durability , the kailh LH Switches give alifespan up to 50 milion keystrokes\nHigh Quality Aluminium Panel\nSolid Aluminium structure for stability and durability\nCustom RGB Light Panel\nGold Plated CONNECTOR\nFull Keys Anti - Ghostring\nDouble Color Injection Keycaps\nSuspended Keycaps Design ', 'Keyboard_Imperion_Mech_7.jpg', 370000, '2019-10-17 02:41:05', '003', 0),
(37, 12, 4, 'Keyboard Logitech G213 Prodigy Mechanical', 'Spill resistance:\nTested with 60ml liquid spillage\nConnection Type: USB 2.0\nUSB Protocol: USB 2.0\nUSB Speed: Full Speed\nIndicator LIghts (LED): Yes\nLCD Display: No\nBacklighting: RGB\nCable Length (Power/Charging): 1.8 M\nHeight: 218 mm\nWidth: 452 mm\nDepth: 33 mm\nWeight: 1000 g', 'Keyboard_Logitech_213.jpg', 625000, '2019-10-17 02:41:16', '003', 8);

-- --------------------------------------------------------

--
-- Table structure for table `subkategori`
--

CREATE TABLE `subkategori` (
  `idsubkategori` int(6) UNSIGNED NOT NULL,
  `idkategori` int(4) UNSIGNED NOT NULL,
  `nama_subkategori` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `subkategori`
--

INSERT INTO `subkategori` (`idsubkategori`, `idkategori`, `nama_subkategori`) VALUES
(1, 1, 'Business'),
(2, 1, 'Gaming'),
(3, 1, '2 in 1'),
(4, 2, 'Cellphone'),
(5, 2, 'Featurephone'),
(6, 2, 'Smartphone'),
(7, 3, 'Tube'),
(8, 3, 'LCD'),
(9, 3, 'Curve 180'),
(10, 4, 'Headset'),
(11, 4, 'Mouse'),
(12, 4, 'Keyboard'),
(13, 4, 'Mic');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `kategori`
--
ALTER TABLE `kategori`
  ADD PRIMARY KEY (`idkategori`),
  ADD UNIQUE KEY `nama_kategori` (`nama_kategori`,`detail`);
ALTER TABLE `kategori` ADD FULLTEXT KEY `idkategori` (`nama_kategori`,`detail`);

--
-- Indexes for table `pegawai`
--
ALTER TABLE `pegawai`
  ADD PRIMARY KEY (`idpegawai`);

--
-- Indexes for table `produk`
--
ALTER TABLE `produk`
  ADD PRIMARY KEY (`idproduk`);

--
-- Indexes for table `subkategori`
--
ALTER TABLE `subkategori`
  ADD PRIMARY KEY (`idsubkategori`),
  ADD UNIQUE KEY `nama_subkategori` (`nama_subkategori`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `kategori`
--
ALTER TABLE `kategori`
  MODIFY `idkategori` int(4) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `pegawai`
--
ALTER TABLE `pegawai`
  MODIFY `idpegawai` int(4) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `produk`
--
ALTER TABLE `produk`
  MODIFY `idproduk` int(12) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT for table `subkategori`
--
ALTER TABLE `subkategori`
  MODIFY `idsubkategori` int(6) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
