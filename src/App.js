import logo from './logo.svg';
import './App.css';
import { Routes,Route } from 'react-router-dom';
import Listar from './pages/listar';
import Cadastrar from './pages/cadastrar';
function App() {
  return (
    <div>
      <Routes>
        <Route path="/" element={<Listar/>}/>
        <Route path="/cadastrar" element={<Cadastrar/>}/>
      </Routes>
    </div>
  );
}

export default App;
