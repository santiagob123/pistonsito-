import React, { useEffect, useState } from 'react';
import { View, Text, FlatList, StyleSheet, Alert, TextInput, Modal, TouchableOpacity } from 'react-native';
import { Picker } from '@react-native-picker/picker';

const ManageCitasScreen = () => {
  const [citas, setCitas] = useState([]);
  const [selectedCita, setSelectedCita] = useState(null);
  const [modalVisible, setModalVisible] = useState(false);
  const [createModalVisible, setCreateModalVisible] = useState(false);
  const [newCita, setNewCita] = useState({
    nombre: '',
    apellido: '',
    tipo_documento: '',
    numero_documento: '',
    tipo_servicio: '',
    dia: '',
    hora: '',
  });

  // Función para obtener todas las citas desde la API
  const fetchCitas = async () => {
    try {
      const response = await fetch('http://10.1.193.215:8000/api/cita');
      const data = await response.json();
      if (response.ok) {
        setCitas(data.citas);
      } else {
        Alert.alert('Error', data.message || 'No se pudieron obtener las citas');
      }
    } catch (error) {
      Alert.alert('Error', 'No se pudo conectar con el servidor');
    }
  };

  // Función para crear una nueva cita
  const createCita = async () => {
    try {
      const response = await fetch('http://10.1.193.215:8000/api/cita', {
        method: 'POST',
        headers: {
          'Content-Type': 'application/json',
        },
        body: JSON.stringify(newCita),
      });
      if (response.ok) {
        Alert.alert('Éxito', 'Cita creada correctamente');
        setCreateModalVisible(false);
        setNewCita({
          nombre: '',
          apellido: '',
          tipo_documento: '',
          numero_documento: '',
          tipo_servicio: '',
          dia: '',
          hora: '',
        });
        fetchCitas();
      } else {
        Alert.alert('Error', 'No se pudo crear la cita');
      }
    } catch (error) {
      Alert.alert('Error', 'No se pudo conectar con el servidor');
    }
  };

  // Función para actualizar una cita
  const updateCita = async () => {
    try {
      // Formatear los datos antes de enviarlos
      const formattedCita = {
        nombre: selectedCita.nombre.trim(),
        apellido: selectedCita.apellido.trim(),
        tipo_documento: selectedCita.tipo_documento,
        numero_documento: selectedCita.numero_documento.toString().padStart(10, '0'), // Asegurar 10 dígitos
        tipo_servicio: selectedCita.tipo_servicio,
        dia: selectedCita.dia.split('T')[0], // Extraer solo la fecha en formato YYYY-MM-DD
        hora: selectedCita.hora.trim(), // Asegurar que la hora esté en formato HH:mm
      };

      console.log('Datos enviados para actualizar:', formattedCita);

      // Realizar la solicitud PUT al servidor
      const response = await fetch(`http://10.1.193.215:8000/api/cita/${selectedCita.id}`, {
        method: 'PUT',
        headers: {
          'Content-Type': 'application/json',
        },
        body: JSON.stringify(formattedCita),
      });

      const responseText = await response.text(); // Obtener la respuesta como texto
      console.log('Respuesta del servidor:', responseText);

      if (response.ok) {
        Alert.alert('Éxito', 'Cita actualizada correctamente');
        setModalVisible(false);
        fetchCitas(); // Actualizar la lista de citas
      } else {
        console.log('Error del servidor:', responseText);
        Alert.alert('Error', 'No se pudo actualizar la cita. Verifica los datos e inténtalo nuevamente.');
      }
    } catch (error) {
      console.log('Error de conexión:', error);
      Alert.alert('Error', 'No se pudo conectar con el servidor. Inténtalo más tarde.');
    }
  };
  // Función para eliminar una cita
  const deleteCita = async (id) => {
    try {
      const response = await fetch(`http://10.1.193.215:8000/api/cita/${id}`, {
        method: 'DELETE',
      });
      if (response.ok) {
        Alert.alert('Éxito', 'Cita eliminada correctamente');
        fetchCitas();
      } else {
        Alert.alert('Error', 'No se pudo eliminar la cita');
      }
    } catch (error) {
      Alert.alert('Error', 'No se pudo conectar con el servidor');
    }
  };

  useEffect(() => {
    fetchCitas();
  }, []);

  return (
    <View style={styles.container}>
      <Text style={styles.title}>Administrar Citas</Text>

      <TouchableOpacity style={styles.createButton} onPress={() => setCreateModalVisible(true)}>
        <Text style={styles.buttonText}>Crear Nueva Cita</Text>
      </TouchableOpacity>

      <FlatList
        data={citas}
        keyExtractor={(item) => item.id.toString()}
        renderItem={({ item }) => (
          <View style={styles.citaItem}>
            <Text style={styles.citaText}>{`Nombre: ${item.nombre} ${item.apellido}`}</Text>
            <Text style={styles.citaText}>{`Documento: ${item.tipo_documento} ${item.numero_documento}`}</Text>
            <Text style={styles.citaText}>{`Servicio: ${item.tipo_servicio}`}</Text>
            <Text style={styles.citaText}>{`Fecha: ${item.dia}`}</Text>
            <Text style={styles.citaText}>{`Hora: ${item.hora}`}</Text>
            <View style={styles.buttonContainer}>
              <TouchableOpacity
                style={styles.editButton}
                onPress={() => {
                  setSelectedCita(item);
                  setModalVisible(true);
                }}
              >
                <Text style={styles.buttonText}>Editar</Text>
              </TouchableOpacity>
              <TouchableOpacity style={styles.deleteButton} onPress={() => deleteCita(item.id)}>
                <Text style={styles.buttonText}>Eliminar</Text>
              </TouchableOpacity>
            </View>
          </View>
        )}
      />

      {/* Modal para crear citas */}
      <Modal visible={createModalVisible} animationType="slide">
        <View style={styles.modalContainer}>
          <Text style={styles.modalTitle}>Crear Nueva Cita</Text>
          <TextInput
            style={styles.input}
            placeholder="Nombre"
            value={newCita.nombre}
            onChangeText={(text) => setNewCita({ ...newCita, nombre: text })}
          />
          <TextInput
            style={styles.input}
            placeholder="Apellido"
            value={newCita.apellido}
            onChangeText={(text) => setNewCita({ ...newCita, apellido: text })}
          />
          <Picker
            selectedValue={newCita.tipo_documento}
            style={styles.picker}
            onValueChange={(itemValue) => setNewCita({ ...newCita, tipo_documento: itemValue })}
          >
            <Picker.Item label="Seleccione Tipo de Documento" value="" />
            <Picker.Item label="Cédula de Ciudadanía" value="cc" />
            <Picker.Item label="Tarjeta de Identidad" value="ti" />
            <Picker.Item label="Cédula de Extranjería" value="cxe" />
            <Picker.Item label="Pasaporte" value="pasaporte" />
          </Picker>
          <TextInput
            style={styles.input}
            placeholder="Número de Documento"
            value={newCita.numero_documento}
            onChangeText={(text) => setNewCita({ ...newCita, numero_documento: text })}
            keyboardType="numeric"
          />
          <Picker
            selectedValue={newCita.tipo_servicio}
            style={styles.picker}
            onValueChange={(itemValue) => setNewCita({ ...newCita, tipo_servicio: itemValue })}
          >
            <Picker.Item label="Seleccione un servicio" value="" />
            <Picker.Item label="Cambio de Aceite" value="cambio de aceite" />
            <Picker.Item label="Revisión General" value="revision general" />
            <Picker.Item label="Mantenimiento General" value="mantenimiento general" />
          </Picker>
          <TextInput
            style={styles.input}
            placeholder="Fecha"
            value={newCita.dia}
            onChangeText={(text) => setNewCita({ ...newCita, dia: text })}
          />
          <TextInput
            style={styles.input}
            placeholder="Hora"
            value={newCita.hora}
            onChangeText={(text) => setNewCita({ ...newCita, hora: text })}
          />
          <View style={styles.buttonContainer}>
            <TouchableOpacity style={styles.saveButton} onPress={createCita}>
              <Text style={styles.buttonText}>Crear</Text>
            </TouchableOpacity>
            <TouchableOpacity style={styles.cancelButton} onPress={() => setCreateModalVisible(false)}>
              <Text style={styles.buttonText}>Cancelar</Text>
            </TouchableOpacity>
          </View>
        </View>
      </Modal>

      {/* Modal para editar citas */}
      <Modal visible={modalVisible} animationType="slide">
        <View style={styles.modalContainer}>
          <Text style={styles.modalTitle}>Editar Cita</Text>
          <TextInput
            style={styles.input}
            placeholder="Nombre"
            value={selectedCita?.nombre}
            onChangeText={(text) => setSelectedCita({ ...selectedCita, nombre: text })}
          />
          <TextInput
            style={styles.input}
            placeholder="Apellido"
            value={selectedCita?.apellido}
            onChangeText={(text) => setSelectedCita({ ...selectedCita, apellido: text })}
          />
          <Picker
            selectedValue={selectedCita?.tipo_documento}
            style={styles.picker}
            onValueChange={(itemValue) => setSelectedCita({ ...selectedCita, tipo_documento: itemValue })}
          >
            <Picker.Item label="Seleccione Tipo de Documento" value="" />
            <Picker.Item label="Cédula de Ciudadanía" value="cc" />
            <Picker.Item label="Tarjeta de Identidad" value="ti" />
            <Picker.Item label="Cédula de Extranjería" value="cxe" />
            <Picker.Item label="Pasaporte" value="pasaporte" />
          </Picker>
          <TextInput
            style={styles.input}
            placeholder="Número de Documento"
            value={selectedCita?.numero_documento}
            onChangeText={(text) => setSelectedCita({ ...selectedCita, numero_documento: text })}
            keyboardType="numeric"
          />
          <Picker
            selectedValue={selectedCita?.tipo_servicio}
            style={styles.picker}
            onValueChange={(itemValue) => setSelectedCita({ ...selectedCita, tipo_servicio: itemValue })}
          >
            <Picker.Item label="Seleccione un servicio" value="" />
            <Picker.Item label="Cambio de Aceite" value="cambio de aceite" />
            <Picker.Item label="Revisión General" value="revision general" />
            <Picker.Item label="Mantenimiento General" value="mantenimiento general" />
          </Picker>
          <TextInput
            style={styles.input}
            placeholder="Fecha"
            value={selectedCita?.dia}
            onChangeText={(text) => setSelectedCita({ ...selectedCita, dia: text })}
          />
          <TextInput
            style={styles.input}
            placeholder="Hora"
            value={selectedCita?.hora}
            onChangeText={(text) => setSelectedCita({ ...selectedCita, hora: text })}
          />
          <View style={styles.buttonContainer}>
            <TouchableOpacity style={styles.saveButton} onPress={updateCita}>
              <Text style={styles.buttonText}>Guardar</Text>
            </TouchableOpacity>
            <TouchableOpacity style={styles.cancelButton} onPress={() => setModalVisible(false)}>
              <Text style={styles.buttonText}>Cancelar</Text>
            </TouchableOpacity>
          </View>
        </View>
      </Modal>
    </View>
  );
};

const styles = StyleSheet.create({
  container: { flex: 1, padding: 20, backgroundColor: '#1a1a1a' },
  title: { fontSize: 24, fontWeight: 'bold', marginBottom: 20, textAlign: 'center', color: '#e60000' },
  citaItem: {
    padding: 15,
    marginVertical: 10,
    borderWidth: 1,
    borderColor: '#444',
    borderRadius: 10,
    backgroundColor: '#222',
  },
  citaText: { color: '#fff', marginBottom: 5 },
  buttonContainer: { flexDirection: 'row', justifyContent: 'space-between', marginTop: 10 },
  createButton: {
    backgroundColor: '#e60000',
    padding: 12,
    borderRadius: 25,
    alignItems: 'center',
    marginBottom: 20,
  },
  editButton: { backgroundColor: '#4caf50', padding: 12, borderRadius: 25, alignItems: 'center' },
  deleteButton: { backgroundColor: '#f44336', padding: 12, borderRadius: 25, alignItems: 'center' },
  saveButton: { backgroundColor: '#4caf50', padding: 12, borderRadius: 25, alignItems: 'center' },
  cancelButton: { backgroundColor: '#f44336', padding: 12, borderRadius: 25, alignItems: 'center' },
  buttonText: { color: '#fff', fontWeight: 'bold', textAlign: 'center' },
  modalContainer: { flex: 1, padding: 20, justifyContent: 'center', backgroundColor: '#1a1a1a' },
  modalTitle: { fontSize: 20, fontWeight: 'bold', marginBottom: 20, textAlign: 'center', color: '#e60000' },
  input: {
    borderWidth: 1,
    borderColor: '#444',
    borderRadius: 6,
    padding: 12,
    marginBottom: 20,
    backgroundColor: '#222',
    color: '#fff',
  },
  picker: {
    height: 50,
    width: '100%',
    color: '#fff',
    backgroundColor: '#222',
    borderWidth: 1,
    borderColor: '#444',
    borderRadius: 6,
    marginBottom: 20,
  },
});

export default ManageCitasScreen;