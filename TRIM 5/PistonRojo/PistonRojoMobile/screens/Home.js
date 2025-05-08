import React from 'react';
import { View, Text, StyleSheet, Image, Dimensions, Button, ScrollView } from 'react-native';
import Carousel from 'react-native-reanimated-carousel';
import * as Device from 'expo-device';

const { width: screenWidth } = Dimensions.get('window');
const isWeb = Device.osName === 'Web';

const Home = ({ navigation }) => {
  const carouselItems = [
    { title: 'Mantenimiento Preventivo', image: require('../assets/imagenes/mantenimiento2.jpg') },
    { title: 'Reparación de Motores', image: require('../assets/imagenes/22.png') },
    { title: 'Reparación de Motores', image: require('../assets/imagenes/imagen-reparacion.webp') },
    
  ];

  return (
    <ScrollView 
      style={styles.container} 
      contentContainerStyle={{ flexGrow: 1 }}
      keyboardShouldPersistTaps="handled"
      showsVerticalScrollIndicator={true}
    >
      {/* Botón para iniciar sesión */}
      <View style={styles.loginButtonContainer}>
        <Button
          title="Iniciar Sesión / Registrarse"
          onPress={() => navigation.navigate('LoginScreen')}
        />
      </View>

      <View style={{ flex: 1 }}>
        {/* Logo */}
        <View style={styles.header}>
          <Image source={require('../assets/imagenes/Logo.png')} style={styles.logo} />
          <Text style={styles.title}>Piston Rojo</Text>
        </View>

        {/* Carrusel */}
        <Carousel
          loop
          width={screenWidth * 0.95} // Ocupa el 95% del ancho de la pantalla
          height={screenWidth * 0.5} // La altura será proporcional al ancho
          autoPlay={true}
          data={carouselItems}
          scrollAnimationDuration={1000}
          renderItem={({ item }) => (
            <View style={styles.carouselItem}>
              <Image
                source={item.image}
                style={styles.carouselImage}
                resizeMode="cover"
              />
              <Text style={styles.carouselText}>{item.title}</Text>
            </View>
          )}
        />

        {/* Secciones */}
        <View style={styles.section}>
          <Text style={styles.sectionTitle}>Bienvenido</Text>
          <Text style={styles.sectionDescription}>
            Confía en nosotros para mantener tu moto en las mejores condiciones.
          </Text>
        </View>

        <View style={styles.section}>
          <Text style={styles.sectionTitle}>Sobre Nosotros</Text>
          <Text style={styles.sectionDescription}>
            Somos una microempresa dedicada al mantenimiento y reparación de motocicletas.
          </Text>
          <Button
            title="Leer más"
            onPress={() => navigation.navigate('AboutUs')}
          />
        </View>

        <View style={styles.section}>
          <Text style={styles.sectionTitle}>Nuestros Servicios</Text>
          <Text style={styles.sectionDescription}>
            Ofrecemos mantenimiento preventivo, reparación de motores, y más.
          </Text>
          <Button
            title="Ver Servicios"
            onPress={() => navigation.navigate('Services')}
          />
        </View>

        <View style={styles.section}>
          <Text style={styles.sectionTitle}>Conócenos</Text>
          <Text style={styles.sectionDescription}>
            Visítanos en nuestra sede en Bogotá, Colombia.
          </Text>
          <Button
            title="Más Información"
            onPress={() => navigation.navigate('KnowUs')}
          />
        </View>

        <View style={styles.section}>
          <Text style={styles.sectionTitle}>Testimonios</Text>
          <Text style={styles.sectionDescription}>
            "Excelente servicio, mi moto quedó como nueva. ¡Recomendado!" - Juan Pérez
          </Text>
          <Text style={styles.sectionDescription}>
            "Atención rápida y profesional. Muy satisfecho." - María Gómez
          </Text>
        </View>

        <View style={styles.section}>
          <Text style={styles.sectionTitle}>Ubicación</Text>
          <Text style={styles.sectionDescription}>
            Encuentra nuestra sede en Bogotá, Colombia.
          </Text>
          <Button
            title="Ver Mapa"
            onPress={() => navigation.navigate('MapScreen')}
          />
        </View>

        <View style={styles.section}>
          <Text style={styles.sectionTitle}>Contáctanos</Text>
          <Text style={styles.sectionDescription}>
            Teléfono: +57 123 456 7890
          </Text>
          <Text style={styles.sectionDescription}>
            Email: contacto@pistonrojo.com
          </Text>
          <Button
            title="Enviar Mensaje"
            onPress={() => navigation.navigate('Contact')}
          />
        </View>

        {/* Footer */}
        <View style={styles.footer}>
          <Text style={styles.footerText}>© 2025 Piston Rojo. Todos los derechos reservados.</Text>
        </View>

        {/* Espacio adicional al final */}
        <View style={{ height: 100 }} />
      </View>
    </ScrollView>
  );
};

const styles = StyleSheet.create({
  container: { 
    flex: 1, 
    backgroundColor: '#fff', 
    paddingHorizontal: 10 
  },
  loginButtonContainer: { 
    marginVertical: 10, 
    alignItems: 'center' 
  },
  header: { 
    alignItems: 'center', 
    marginVertical: 20 
  },
  logo: { 
    width: 100, 
    height: 100 
  },
  title: { 
    fontSize: 24, 
    fontWeight: 'bold', 
    color: '#ff0000' 
  },
  section: { 
    paddingVertical: 15, 
    paddingHorizontal: 10, 
    marginVertical: 10, 
    backgroundColor: '#f9f9f9', 
    borderRadius: 10 
  },
  sectionTitle: { 
    fontSize: 22, 
    fontWeight: 'bold', 
    marginBottom: 5, 
    color: '#333' 
  },
  sectionDescription: { 
    fontSize: 16, 
    color: '#555', 
    lineHeight: 22 
  },
  carouselItem: {
    alignItems: 'center',
    justifyContent: 'center',
    width: '100%',
    height: '100%',
    overflow: 'hidden',
    borderRadius: 10,
  },
  carouselImage: {
    width: '100%',
    height: '100%',
    borderRadius: 10,
  },
  carouselText: { 
    marginTop: 10, 
    fontSize: 16, 
    fontWeight: 'bold' 
  },
  footer: {
    marginTop: 20,
    paddingVertical: 10,
    backgroundColor: '#333',
    alignItems: 'center',
  },
  footerText: {
    color: '#fff',
    fontSize: 14,
  },
});

export default Home;