const BASE_URL = "http://gaellebriet-server.eddi.cloud:8090";


const ApiService = {
  async fetchAll(type) {
    try {
      const response = await fetch(`${BASE_URL}/api/${type}`);
      const data = await response.json();
      return data;
    } catch (error) {
      throw new Error(`Failed to fetch resource of type : ${type}`);
    }
  },

  async fetchFieldValues(fieldId) {
    try {
      const response = await fetch(`${BASE_URL}/api/fields/${fieldId}`);
      const data = await response.json();
      return data;
    } catch (error) {
      throw new Error(`Failed to fetch values for field with ID: ${fieldId}`);
    }
  },

  async create(type, data) {
    try {
      const response = await fetch(`${BASE_URL}/api/${type}`, {
        method: "POST",
        headers: {
          "Content-Type": "application/json"
        },
        body: JSON.stringify(data)
      });
      const responseData = await response.json();
      return responseData;
    } catch (error) {
      throw new Error(`Failed to create resource of type : ${type}`);
    }
  },

  async fetchOne(type, id) {
    try {
      const response = await fetch(`${BASE_URL}/api/${type}/${id}`);
      const data = await response.json();
      return data;
    } catch (error) {
      throw new Error(`Failed to fetch resource of type : ${type} with id : ${id}`);
    }
  },

  async delete(type, id) {
    try {
      const response = await fetch(`${BASE_URL}/api/${type}/${id}`, {
        method: "DELETE",
        headers: {
          "Content-Type": "application/json"
        }
      });
      const responseData = await response.json();
      return responseData;
    } catch (error) {
      throw new Error(`Failed to delete resource of type : ${type} with id : ${id}`);
    }
  }
};

export default ApiService;
