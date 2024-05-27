import logo from './logo.svg';
import './App.css';
import { Routes,Route } from 'react-router-dom';
import Listar from './pages/listar';
function App() {
  return (
    <div>
      <Routes>
        <Route path="/" element={<Listar/>}/>
      </Routes>
    </div>
  );
}

export default App;
