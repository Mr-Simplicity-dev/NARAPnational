import express from 'express';
import PortfolioItem from '../models/PortfolioItem.js';
import { buildCRUDRoutes } from './_util.js';

const router = express.Router();
buildCRUDRoutes({ router, Model: PortfolioItem, resource: 'portfolio' });

export default router;
