ALTER TABLE weather_stations_records ALTER pressure_absolute DROP NOT NULL;
ALTER TABLE weather_stations_records ALTER pressure_relative DROP NOT NULL;
ALTER TABLE weather_stations_records ALTER temperature_indoor DROP NOT NULL;
ALTER TABLE weather_stations_records ALTER temperature_outdoor DROP NOT NULL;
ALTER TABLE weather_stations_records ALTER humidity_indoor DROP NOT NULL;
ALTER TABLE weather_stations_records ALTER humidity_outdoor DROP NOT NULL;
ALTER TABLE weather_stations_records ALTER wind_speed DROP NOT NULL;
ALTER TABLE weather_stations_records ALTER wind_azimuth DROP NOT NULL;
ALTER TABLE weather_stations_records ALTER wind_gust DROP NOT NULL;
