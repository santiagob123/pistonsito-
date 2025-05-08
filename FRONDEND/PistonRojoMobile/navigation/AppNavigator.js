import React from 'react';
import { NavigationContainer } from '@react-navigation/native';
import { createStackNavigator } from '@react-navigation/stack';
import Home from '../screens/Home';
import AboutUs from '../screens/AboutUs';
import Services from '../screens/Services';
import KnowUs from '../screens/KnowUs';
import MapScreen from '../screens/MapScreen'; // Asegúrate de importar la pantalla


const Stack = createStackNavigator();

const AppNavigator = () => {
  return (
    <NavigationContainer>
      <Stack.Navigator initialRouteName="Home">
        <Stack.Screen name="Home" component={Home} options={{ title: 'Inicio' }} />
        <Stack.Screen name="AboutUs" component={AboutUs} options={{ title: 'Sobre Nosotros' }} />
        <Stack.Screen name="Services" component={Services} options={{ title: 'Servicios' }} />
        <Stack.Screen name="KnowUs" component={KnowUs} options={{ title: 'Conócenos' }} />
        <Stack.Screen name="MapScreen" component={MapScreen} options={{ title: 'Mapa' }} />
      </Stack.Navigator>
    </NavigationContainer>
  );
};

export default AppNavigator;