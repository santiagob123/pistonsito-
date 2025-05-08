// filepath: c:\xampp\htdocs\PistonRojo\PistonRojoMobile\App.js
import React from 'react';
import { NavigationContainer } from '@react-navigation/native';
import { createStackNavigator } from '@react-navigation/stack';
import Home from './screens/Home';
import LoginScreen from './screens/LoginScreen';
import RegisterScreen from './screens/RegisterScreen';
import NextScreen from './screens/NextScreen';
import AdminDashboard from './screens/AdminDashboard';
import UserDashboard from './screens/UserDashboard';
import ManageCitasScreen from './screens/ManageCitasScreen';
import AboutUs from './screens/AboutUs';
import Services from './screens/Services';
import KnowUs from './screens/KnowUs';
import MapScreen from './screens/MapScreen';


const Stack = createStackNavigator();

export default function App() {
  return (
    <NavigationContainer>
      <Stack.Navigator initialRouteName="Home">
        {/* Pantalla principal */}
        <Stack.Screen name="Home" component={Home} options={{ title: 'Inicio' }} />

        {/* Pantallas de autenticación */}
        <Stack.Screen name="LoginScreen" component={LoginScreen} options={{ title: 'Iniciar Sesión' }} />
        <Stack.Screen name="RegisterScreen" component={RegisterScreen} options={{ title: 'Registrarse' }} />

        {/* Pantalla después del login */}
        <Stack.Screen name="NextScreen" component={NextScreen} options={{ title: 'Bienvenido' }} />

        {/* Pantallas específicas por rol */}
        <Stack.Screen name="AdminDashboard" component={AdminDashboard} options={{ title: 'Panel de Administrador' }} />
        <Stack.Screen name="UserDashboard" component={UserDashboard} options={{ title: 'Panel de Usuario' }} />

        {/* Pantalla de gestión de citas */}
        <Stack.Screen name="ManageCitasScreen" component={ManageCitasScreen} options={{ title: 'Gestión de Citas' }} />

        {/* Pantallas adicionales */}
        <Stack.Screen name="AboutUs" component={AboutUs} options={{ title: 'Sobre Nosotros' }} />
        <Stack.Screen name="Services" component={Services} options={{ title: 'Servicios' }} />
        <Stack.Screen name="KnowUs" component={KnowUs} options={{ title: 'Conócenos' }} />
        <Stack.Screen name="MapScreen" component={MapScreen} options={{ title: 'Ubicación' }} />
        
      </Stack.Navigator>
    </NavigationContainer>
  );
}