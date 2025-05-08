import React, { useState } from 'react';
import { View, Text, TextInput, Button, StyleSheet, Alert } from 'react-native';

const RegisterScreen = ({ navigation }) => {
  const [formData, setFormData] = useState({
    tipoDocumento: '',
    numeroDocumento: '',
    userName: '',
    userApellido: '',
    userTelefono: '',
    userDireccion: '',
    userEmail: '',
    userPassword: '',
  });

  const handleInputChange = (name, value) => {
    setFormData({ ...formData, [name]: value });
  };

  const handleRegister = async () => {
    try {
      const response = await fetch('http://10.1.193.215/PistonRojo/Controlador/controladorUsuario.php', {
        method: 'POST',
        headers: {
          'Content-Type': 'application/x-www-form-urlencoded',
        },
        body: new URLSearchParams({
          accion: 'registrar', // Campo requerido por el controlador
          tipoDocumento: formData.tipoDocumento,
          numeroDocumento: formData.numeroDocumento,
          userName: formData.userName,
          userApellido: formData.userApellido,
          userTelefono: formData.userTelefono,
          userDireccion: formData.userDireccion,
          userEmail: formData.userEmail,
          userPassword: formData.userPassword,
        }).toString(),
      });

      const data = await response.json();

      if (data.success) {
        Alert.alert('Éxito', data.message);
        navigation.navigate('LoginScreen'); // Redirige a la pantalla de login
      } else {
        Alert.alert('Error', data.message);
      }
    } catch (error) {
      Alert.alert('Error', 'No se pudo conectar con el servidor');
    }
  };

  return (
    <View style={styles.container}>
      <Text style={styles.title}>Registrarse</Text>
      <TextInput
        style={styles.input}
        placeholder="Tipo de Documento"
        value={formData.tipoDocumento}
        onChangeText={(value) => handleInputChange('tipoDocumento', value)}
      />
      <TextInput
        style={styles.input}
        placeholder="Número de Documento"
        value={formData.numeroDocumento}
        onChangeText={(value) => handleInputChange('numeroDocumento', value)}
      />
      <TextInput
        style={styles.input}
        placeholder="Nombre"
        value={formData.userName}
        onChangeText={(value) => handleInputChange('userName', value)}
      />
      <TextInput
        style={styles.input}
        placeholder="Apellido"
        value={formData.userApellido}
        onChangeText={(value) => handleInputChange('userApellido', value)}
      />
      <TextInput
        style={styles.input}
        placeholder="Teléfono"
        value={formData.userTelefono}
        onChangeText={(value) => handleInputChange('userTelefono', value)}
      />
      <TextInput
        style={styles.input}
        placeholder="Dirección"
        value={formData.userDireccion}
        onChangeText={(value) => handleInputChange('userDireccion', value)}
      />
      <TextInput
        style={styles.input}
        placeholder="Correo Electrónico"
        value={formData.userEmail}
        onChangeText={(value) => handleInputChange('userEmail', value)}
        keyboardType="email-address"
        autoCapitalize="none"
      />
      <TextInput
        style={styles.input}
        placeholder="Contraseña"
        value={formData.userPassword}
        onChangeText={(value) => handleInputChange('userPassword', value)}
        secureTextEntry
      />
      <Button title="Registrarse" onPress={handleRegister} />
    </View>
  );
};

const styles = StyleSheet.create({
  container: { flex: 1, justifyContent: 'center', alignItems: 'center', padding: 20 },
  title: { fontSize: 24, fontWeight: 'bold', marginBottom: 20 },
  input: { width: '100%', padding: 10, borderWidth: 1, borderColor: '#ccc', borderRadius: 5, marginBottom: 20 },
});

export default RegisterScreen;