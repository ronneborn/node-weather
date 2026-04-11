INSERT INTO users(name,email,password_hash,role,status,created_at,updated_at) VALUES
('Admin Surface','admin@surfacesolutions.se','$2y$10$uR7qUAxC2OejQa2XfAm3UuW9D5Lyy8Ojq2Qh9Q9N5NvbwY9Yyy4ri','admin','active',NOW(),NOW());

INSERT INTO pages(title,slug,h1,content,meta_title,meta_description,status,created_at,updated_at) VALUES
('Startsida','home','Taktvätt och målning i Västerås','Vi hjälper kunder i Västerås med allt från taktvätt till byggstädning.','SurfaceSolutions Västerås','Lokal specialist på tvätt, målning och städ i Västerås.','published',NOW(),NOW()),
('Om oss','om-oss','Om SurfaceSolutions','Lokalt team med utbildad personal och tydliga garantier.','Om oss | SurfaceSolutions','Lär känna SurfaceSolutions i Västerås.','published',NOW(),NOW()),
('Kontakt','kontakt','Kontakta SurfaceSolutions','Skicka in en offertförfrågan så återkommer vi snabbt.','Kontakt | SurfaceSolutions','Kontakta oss för kostnadsfri offert.','published',NOW(),NOW()),
('Tjänster','tjanster','Alla tjänster','Vi erbjuder tvätt, målning, behandling och städ.','Tjänster | SurfaceSolutions','Se alla tjänster i Västerås.','published',NOW(),NOW()),
('Områden','omraden','Områden vi arbetar i','Vi arbetar i Västerås och närliggande orter.','Områden | SurfaceSolutions','Våra områden i Västmanland och Sörmland.','published',NOW(),NOW());

INSERT INTO services(name,slug,short_description,content,meta_title,meta_description,status,created_at,updated_at) VALUES
('Taktvätt','taktvatt','Skonsam rengöring av tak med lång hållbarhet.','Vi tvättar tak med metod anpassad till material och påväxt.','Taktvätt Västerås | SurfaceSolutions','Boka taktvätt i Västerås med trygg process.','active',NOW(),NOW()),
('Takmålning','takmalning','Förlänger takets livslängd och förbättrar intrycket.','Takmålning med rätt förarbete och vädertåliga färgsystem.','Takmålning Västerås | SurfaceSolutions','Takmålning i Västerås med garanti.','active',NOW(),NOW()),
('Fasadtvätt','fasadtvatt','Ren och fräsch fasad utan hårda kemikalier.','Fasadtvätt för trä, puts och tegel.','Fasadtvätt Västerås | SurfaceSolutions','Professionell fasadtvätt i Västerås.','active',NOW(),NOW()),
('Fasadmålning','fasadmalning','Målning med fokus på hållbarhet och finish.','Vi målar om fasader med dokumenterad process.','Fasadmålning Västerås | SurfaceSolutions','Fasadmålning för villa och BRF i Västerås.','active',NOW(),NOW()),
('Invändig målning','invandig-malning','Noggrant måleri för hem och kontor.','Invändigt måleri med tydlig planering och skydd.','Invändig målning Västerås | SurfaceSolutions','Målare i Västerås för invändiga ytor.','active',NOW(),NOW()),
('Altantvätt','altantvatt','Rengöring av trall och uteplatser.','Vi tvättar altaner och tar bort alger och smuts.','Altantvätt Västerås | SurfaceSolutions','Skonsam altantvätt i Västerås.','active',NOW(),NOW()),
('Sten- och plattrengöring','sten-och-plattrengoring','Rena gångar, uppfarter och uteplatser.','Effektiv rengöring av marksten och plattor.','Stenrengöring Västerås | SurfaceSolutions','Rengöring av stenytor i Västerås.','active',NOW(),NOW()),
('Byggstädning','byggstadning','Städning efter bygg och renovering.','Byggstädning med checklista för slutbesiktning.','Byggstädning Västerås | SurfaceSolutions','Byggstädning i Västerås med snabb start.','active',NOW(),NOW());

INSERT INTO locations(name,slug,intro,content,meta_title,meta_description,status,created_at,updated_at) VALUES
('Västerås','vasteras','Primärt arbetsområde för alla våra tjänster.','Vi är lokala i Västerås och kan erbjuda snabba tider.','Tjänster i Västerås | SurfaceSolutions','Yttvätt, målning och städ i Västerås.','active',NOW(),NOW()),
('Hallstahammar','hallstahammar','Vi utför uppdrag i Hallstahammar med omnejd.','Regelbunden närvaro för tvätt och måleriuppdrag.','Tjänster i Hallstahammar | SurfaceSolutions','Lokala tjänster nära Hallstahammar.','active',NOW(),NOW()),
('Köping','koping','Köping är en viktig del av vårt upptagningsområde.','Vi hjälper privatpersoner och företag i Köping.','Tjänster i Köping | SurfaceSolutions','Ytbehandling och städ i Köping.','active',NOW(),NOW()),
('Enköping','enkoping','Tillgängliga tider även i Enköping.','Vi planerar rutter veckovis i Enköping.','Tjänster i Enköping | SurfaceSolutions','Boka tjänster i Enköping.','active',NOW(),NOW()),
('Eskilstuna','eskilstuna','Vi erbjuder utvalda tjänster i Eskilstuna.','Fokus på tak, fasad och byggstädning.','Tjänster i Eskilstuna | SurfaceSolutions','Service inom tvätt, målning och städ i Eskilstuna.','active',NOW(),NOW());

INSERT INTO service_location_pages(service_id,location_id,service_slug,location_slug,title,slug,h1,intro,content,meta_title,meta_description,status,created_at,updated_at) VALUES
(1,1,'taktvatt','vasteras','Taktvätt i Västerås','taktvatt-vasteras','Taktvätt Västerås','Skonsam taktvätt för villor och fastigheter i Västerås.','Vi tar bort mossa, alger och smuts med rätt metod för ditt tak.','Taktvätt Västerås | SurfaceSolutions','Boka taktvätt i Västerås med snabb offert.','published',NOW(),NOW()),
(2,1,'takmalning','vasteras','Takmålning i Västerås','takmalning-vasteras','Takmålning Västerås','Förnya takets utseende och skydd i Västerås.','Vi utför takmålning med noggrant förarbete och rätt färgsystem.','Takmålning Västerås | SurfaceSolutions','Takmålning i Västerås med garanti.','published',NOW(),NOW()),
(3,1,'fasadtvatt','vasteras','Fasadtvätt i Västerås','fasadtvatt-vasteras','Fasadtvätt Västerås','Rengöring av fasad för bättre livslängd.','Vi tvättar trä, puts och tegel med skonsamma metoder.','Fasadtvätt Västerås | SurfaceSolutions','Fasadtvätt för villa och BRF i Västerås.','published',NOW(),NOW()),
(8,1,'byggstadning','vasteras','Byggstädning i Västerås','byggstadning-vasteras','Byggstädning Västerås','Effektiv byggstädning efter renovering.','Vi städar byggdamm och grovsmuts inför inflyttning och besiktning.','Byggstädning Västerås | SurfaceSolutions','Trygg byggstädning i Västerås.','published',NOW(),NOW()),
(6,1,'altantvatt','vasteras','Altantvätt i Västerås','altantvatt-vasteras','Altantvätt Västerås','Skonsam tvätt av trall och uteplats.','Vi återställer altanens yta med rätt tryck och medel.','Altantvätt Västerås | SurfaceSolutions','Boka altantvätt i Västerås.','published',NOW(),NOW());

INSERT INTO blog_categories(name,slug,created_at,updated_at) VALUES ('Guider','guider',NOW(),NOW()),('Lokalt','lokalt',NOW(),NOW());
INSERT INTO blog_posts(category_id,title,slug,excerpt,content,meta_title,meta_description,status,published_at,created_at,updated_at) VALUES
(1,'När behövs taktvätt i Västerås?','nar-behovs-taktvatt-i-vasteras','Tecken på att ditt tak behöver tvättas.','Mossa, svarta fläckar och fukt är tydliga signaler...','När behövs taktvätt i Västerås?','Guide till taktvätt i Västerås.','published',NOW(),NOW(),NOW()),
(1,'Skillnaden mellan fasadtvätt och fasadmålning','skillnaden-mellan-fasadtvatt-och-fasadmalning','Vad ska göras först?','Fasadtvätt förbereder ytan och kan ibland räcka...','Fasadtvätt eller fasadmålning?','Lär dig välja rätt åtgärd.','published',NOW(),NOW(),NOW()),
(2,'Så planerar du byggstädning efter renovering','planera-byggstadning-efter-renovering','Checklista för en smidig slutstädning.','Starta med grovstäd, följ upp med detaljstädning...','Planera byggstädning','Byggstädning utan missar.','published',NOW(),NOW(),NOW()),
(2,'Varför softwash passar känsliga ytor','varfor-softwash-passar-kansliga-ytor','Skonsam metod för långsiktigt resultat.','Softwash använder lågtryck och biologiskt nedbrytbara medel...','Softwash för känsliga ytor','Trygg tvättmetod i Västerås.','published',NOW(),NOW(),NOW()),
(1,'5 tips inför utvändig målning','5-tips-infor-utvandig-malning','Förarbete och timing gör stor skillnad.','Kontrollera väderfönster, tvätta underlag och välj rätt färg...','Tips för utvändig målning','Få bättre resultat vid fasadmålning.','published',NOW(),NOW(),NOW());

INSERT INTO faqs(question,answer,page_type,page_id,sort_order,status,created_at,updated_at) VALUES
('Hur snabbt kan ni ge offert?','Ofta inom 24 timmar på vardagar.','global',NULL,1,'active',NOW(),NOW()),
('Arbetar ni i hela Västerås?','Ja, vi täcker hela Västerås samt kransorter.','global',NULL,2,'active',NOW(),NOW()),
('Är taktvätt skonsamt för takpannor?','Ja, vi anpassar metod efter material och skick.','service',1,3,'active',NOW(),NOW()),
('När på året är takmålning bäst?','Vanligtvis från vår till tidig höst.','service',2,4,'active',NOW(),NOW()),
('Tar ni med egen utrustning?','Ja, all utrustning och skyddsmaterial ingår.','global',NULL,5,'active',NOW(),NOW()),
('Kan ni hjälpa BRF:er?','Ja, vi arbetar med både BRF och företag.','global',NULL,6,'active',NOW(),NOW()),
('Erbjuder ni garanti?','Ja, vi lämnar tydliga garantivillkor per tjänst.','global',NULL,7,'active',NOW(),NOW()),
('Hur lång tid tar fasadtvätt?','Normalt 1–2 dagar beroende på yta.','service',3,8,'active',NOW(),NOW()),
('Behöver jag vara hemma under jobbet?','Inte alltid, vi kommer överens i förväg.','global',NULL,9,'active',NOW(),NOW()),
('Utför ni flyttstädning?','Ja, vi erbjuder även flyttstädning.','service',8,10,'active',NOW(),NOW()),
('Kan ni tvätta solpaneler?','Ja, skonsam rengöring för bättre effekt.','service',3,11,'active',NOW(),NOW()),
('Vad kostar altantvätt?','Pris beror på yta och skick. Begär offert.','service',6,12,'active',NOW(),NOW()),
('Jobbar ni i Enköping?','Ja, vi har återkommande uppdrag i Enköping.','location',4,13,'active',NOW(),NOW()),
('Hur bokar jag?','Fyll i kontaktformuläret eller ring oss.','global',NULL,14,'active',NOW(),NOW()),
('Använder ni miljövänliga medel?','Ja, vi prioriterar godkända och skonsamma produkter.','global',NULL,15,'active',NOW(),NOW());

INSERT INTO settings(`key`,`value`,created_at,updated_at) VALUES
('company_name','SurfaceSolutions AB',NOW(),NOW()),
('phone','021-12 34 56',NOW(),NOW()),
('email','hej@surfacesolutions.se',NOW(),NOW()),
('address','Västerås, Sverige',NOW(),NOW()),
('footer_text','Lokala experter på tvätt, målning och städ',NOW(),NOW()),
('facebook','https://facebook.com/surfacesolutions',NOW(),NOW()),
('instagram','https://instagram.com/surfacesolutions',NOW(),NOW()),
('meta_suffix','| SurfaceSolutions',NOW(),NOW()),
('default_og_image','/assets/images/og-default.jpg',NOW(),NOW());
