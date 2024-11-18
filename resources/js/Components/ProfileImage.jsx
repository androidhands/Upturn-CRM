import React, { useState, useEffect } from 'react';
import axios from 'axios';

const ProfileImage = ({ userId }) => {
  const [image, setImage] = useState(null);
  const [preview, setPreview] = useState(null);

  // Load existing profile image if available
  useEffect(() => {
    async function fetchProfileImage() {
      try {
        const response = await axios.get(`/api/profile-image/${userId}`);
        setImage(response.data.path);
      } catch (error) {
        console.error("No image found for user.");
      }
    }
    fetchProfileImage();
  }, [userId]);

  const handleImageChange = (event) => {
    const file = event.target.files[0];
    setPreview(URL.createObjectURL(file));
  };

  const handleUpload = async () => {
    const formData = new FormData();
    formData.append("profile_image", preview);

    try {
      const response = await axios.post("/api/profile-image", formData, {
        headers: {
          "Content-Type": "multipart/form-data"
        }
      });
      setImage(response.data.path);
    } catch (error) {
      console.error("Image upload failed.");
    }
  };

  return (
    <div>
      <div>
        <img
          src={preview || `/storage/${image}`}
          alt="Profile"
          style={{ width: '150px', height: '150px', borderRadius: '50%' }}
        />
      </div>
      <input type="file" accept="image/*" onChange={handleImageChange} />
      <button onClick={handleUpload}>Upload</button>
    </div>
  );
};

export default ProfileImage;
