import express from 'express';
import Slider from '../models/Slider.js';
import { buildCRUDRoutes } from './_util.js';

const router = express.Router();
buildCRUDRoutes({ router, Model: Slider, resource: 'sliders' });

export default router;
